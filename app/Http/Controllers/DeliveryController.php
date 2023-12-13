<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{

    public function index() {
        $deliveries = Delivery::orderBy('delivery_date','asc')->with('sales', 'truck')->get();
        return response()->json($deliveries);
    }

    public function store(Request $request) {
        // $request->validate([
        //     'truck_id' => 'required',
        //     'sales_id' => 'required',
        // ]);

        $delivery = Delivery::create($request->all());



        return response()->json($delivery);


    }

    public function orderSuccess(Request $request){
         Delivery::where('id',$request->id)->update([
            "status"=>'completed'
        ]);

        return response()->json([
            "message"=>'Delivery success!'
        ]);
    }

}
