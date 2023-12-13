<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Preorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientHomeController extends Controller
{
    // home page
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->with('raw')->get();
        // $preorders = Preorder::orderBy('id', 'desc')->get();

        return $products;
        if (!$products) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found'
            ]);
        }

        return response()->json($products);
    }


    // 
    public function createOrder(Request $request)
    {
        // $customer_id = auth()->guard('customer')->id();
        $validation = $this->validation($request);
        if ($validation->fails()) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found'
            ]);
        }

        Preorder::create([
            'customer_id' => $request->customer_id,
            'products' => $request->input('products'),
            'quantity' => $request->quantity,
            'city' => $request->city,
            'township' => $request->township,
            'address' => $request->address,
            'orderType' => $request->orderType,
            'status' => $request->status,
            'remark' => $request->remark,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'success'
        ]);
    }



    // validation check
    private function validation($request)
    {
        return Validator::make($request->all(), [
            'customer_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'city' => 'required',
            'township' => 'required',
            'address' => 'required',
            'orderType' => 'required',

        ]);
    }
}
