<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmOrderMail;
use App\Models\Preorder;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SaleController extends Controller
{
    public function index(){
        return Sale::filter(request(['staff','product']))->get();
    }
    //
    public function getPreorders()
    {
        $preorders = Preorder::orderBy('id', 'desc')->get();
        return $preorders;
        if (!$preorders) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found'
            ]);
        }

        return response()->json($preorders);
    }

    public function storePreorder(Request $request,$preOrderId,$department,$ccEmails){
        $newSaleOrder = Sale::create($request->all());
        $selectedSale = Sale::where('id',$newSaleOrder)->get();
        $preorderIds = [];

        foreach($selectedSale as $sale){
            array_push($preorderIds,$sale['preorder_id']);
        }


        foreach($preorderIds as $id){
          $preorder=  Preorder::where('id',$id)->first();
          if($preorder->township === 'yangon') {
            $preorder->delivery_date = Carbon::parse($preorder->created_at)->addDays(7);
        }else{
            $preorder->delivery_date = Carbon::parse($preorder->created_at)->addDays(14);
        }
        }

        $this->confirmOrderAndSendMail($newSaleOrder,$preOrderId,$department,$ccEmails);
    }

    public function confirmOrderAndSendMail($newSaleOrder,$preOrderId,$department,$ccEmails){
        $sale = Sale::where('preorder_id',$preOrderId)->first();
        if($sale->preorder['status'] === "confirmed"){
            $title = 'Dear '+$department;
            $body = 'One new preorder is confirmed.Please make sure to check out preorder list and update your '+$department+' sheet. Thank you!';

                    //warehouse manager email
            Mail::to($newSaleOrder->staff->email)->cc($ccEmails)->send(new ConfirmOrderMail($title, $body));

            return "Email sent successfully!";
        }

    }

    // change status
    public function changeStatus(Request $request)
    {
        $data = Preorder::where('id', $request->id)->first();

        if (!$data) {
            return response()->json([
                'status' => 500,
                'message' => 'internal_server'
            ]);
        }

        $data->update([
            'status' => $request->status
        ]);

        // if($data->status == 'confirm'){

        // }

        return response()->json([
            'status' => 200,
            'message' => 'success'
        ]);
    }
}
