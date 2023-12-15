<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Order;
use App\Models\Staff;
use App\Models\Preorder;
use Illuminate\Http\Request;
use App\Mail\ConfirmOrderMail;
use Illuminate\Support\Facades\Mail;

class SaleController extends Controller
{
    public function index()
    {
        return Sale::filter(request(['staff', 'product']))->get();
    }
    //
    public function getPreorders()
    {
        $preorders = Order::orderBy('id', 'desc')->with('customer')->get();
        return $preorders;
        if (!$preorders) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found'
            ]);
        }

        return response()->json($preorders);
    }

    public function storePreorder(Request $request, $preOrderId)
    {
        $newSaleOrder = Sale::create($request->all());
        $selectedSale = Sale::where('id', $newSaleOrder)->get();
        $preorderIds = [];

        foreach ($selectedSale as $sale) {
            array_push($preorderIds, $sale['preorder_id']);
        }


        foreach ($preorderIds as $id) {
            $preorder =  Order::where('id', $id)->first();
            if ($preorder->township === 'yangon') {
                $preorder->delivery_date = Carbon::parse($preorder->created_at)->addDays(7);
            } else {
                $preorder->delivery_date = Carbon::parse($preorder->created_at)->addDays(14);
            }
        }

        $this->confirmOrderAndSendMail($newSaleOrder, $preOrderId);
    }

    public function confirmOrderAndSendMail($newSaleOrder, $preOrderId)
    {
        $sale = Sale::where('preorder_id', $preOrderId)->first();

        if ($sale->preorder['status'] === "confirmed") {
            $title = 'New Order Arrived!';
            $body = 'One new preorder is confirmed.Please make sure to check out preorder list and update your list sheet. Thank you!';

            //warehouse manager email
            $emails = [
                "awea60505@gmail.com",
                "kyawmhtet23@gmail.com",
                "kaungmyatnoe2016@gmail.com",
                'thiri7301@gmail.com',
                'nitoe1999@gmail.com'
            ];
            Mail::to($emails)->send(new ConfirmOrderMail($title, $body));

            return "Email sent successfully!";
        }
    }

    // change status
    public function changeStatus(Request $request)
    {

        $data = Order::where('id', $request->id)->first();

        if (!$data) {
            return response()->json([
                'status' => 500,
                'message' => 'internal_server'
            ]);
        }

        $data->update([
            'status' => $request->status
        ]);

        $title = 'New Order Arrived!';
        $body = 'One new preorder is confirmed.Please make sure to check out preorder list and update your list sheet. Thank you!';

        //warehouse manager email
        $emails = [
            "awea60505@gmail.com",
            "kyawmhtet23@gmail.com",
            "kaungmyatnoe2016@gmail.com",
            'thiri7301@gmail.com',
            'nitoe1999@gmail.com'
        ];
        Mail::to($emails)->send(new ConfirmOrderMail($title, $body));

        return "Email sent successfully!";

        // if($data->status == 'confirm'){

        // }

        return response()->json([
            'status' => 200,
            'message' => 'success'
        ]);
    }
}
