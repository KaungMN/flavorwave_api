<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmOrderMail;
use App\Models\Preorder;
use App\Models\Sale;
use App\Models\Staff;
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

    public function storePreorder(Request $request,$preOrderId){
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

        $this->confirmOrderAndSendMail($newSaleOrder,$preOrderId);
    }

    public function confirmOrderAndSendMail($newSaleOrder,$preOrderId){
        $sale = Sale::where('preorder_id',$preOrderId)->first();
        $warehouse_man = Staff::where("role_id",2)->where("department_id",4)->first();
        $factory_man = Staff::where("role_id",2)->where("department_id",5)->first();
        if($sale->preorder['status'] === "confirmed"){
            $title = 'New Order Arrived!';
            $body = 'One new preorder is confirmed.Please make sure to check out preorder list and update your list sheet. Thank you!';

                    //warehouse manager email
            Mail::to([$warehouse_man->email,$factory_man->email])->send(new ConfirmOrderMail($title, $body));

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
