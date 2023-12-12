<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            "truck_id"=>['required'],
            "preorder_id"=>['required'],
            "delivery_date"=>['required'],
            "status"=>['required']
        ]);
        $delivery = Delivery::create($data);
        return response()->json($delivery);
    }
}
