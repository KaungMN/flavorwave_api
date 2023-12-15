<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        return Order::filter(request(['status','customer','product']))->get();
    }

    public function getOrders()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return response()->json($orders);
    }

    // Create a new preorder
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'product_id' => 'required',
        //     'customer_id' => 'required',
        //     'box_pcs' => 'required',
        //     'city' => 'required',
        //     'township' => 'required',
        //     'address' => 'required',
        //     'orderType' => 'required',
        //     'status' => 'required',
        //     'remark' => 'nullable',
        //     'delivery_date'=>'nullable'
        // ]);

        $preorder = Order::create($request->all());
        return response()->json($order, 201);
    }


    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order);
    }


    public function update(Request $request, $id)
    {
        // $validatedData = $request->validate([
        //     'product_id' => 'required',
        //     'customer_id' => 'required',
        //     'box_pcs' => 'required',
        //     'city' => 'required',
        //     'township' => 'required',
        //     'address' => 'required',
        //     'orderType' => 'required',
        //     'remark' => 'nullable',
        //     'subtotal'=>
        // ]);

        $order = Order::findOrFail($id);
        $order->update($request->all());

        return response()->json($order, 200);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json('Preorder deleted successfully', 200);
    }

}
