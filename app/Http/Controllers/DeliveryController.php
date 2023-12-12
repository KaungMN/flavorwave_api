<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(){
        $deliveries = Delivery::all();
        return response()->json($deliveries);

    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'truck_id' => 'required',
            'preorder_id' => 'required',
            'delivery_date' => 'required',
            'status' => 'required'

        ]);
    
        
        $delivery = Delivery::create($validatedData);
        return response()->json($delivery, 201);
    }
    public function show($id){
        $delivery = Delivery::findOrFail($id);

        return response()->json($delivery);
    }

    public function update(Request $request,$id){
          $delivery = Delivery::findOrFail($id);
          $delivery->update($request->all());
          return response()->json($delivery);
    }

    public function destroy($id){
        Delivery::findOrFail($id)->delete();
        return response()->json('delivery deleted successfully', 200);
    }
}
