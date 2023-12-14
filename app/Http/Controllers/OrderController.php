<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        return OrderS::filter(request(['status','customer','product']))->get();
    }

    public function getPreorders()
    {
        $preorders = Order::orderBy('id', 'desc')->get();
        return response()->json($preorders);
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
        return response()->json($preorder, 201);
    }


    public function show($id)
    {
        $preorder = Order::findOrFail($id);
        return response()->json($preorder);
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

        $preorder = Order::findOrFail($id);
        $preorder->update($request->all());

        return response()->json($preorder, 200);
    }

    public function destroy($id)
    {
        $preorder = Order::findOrFail($id);
        $preorder->delete();

        return response()->json('Preorder deleted successfully', 200);
    }

}
