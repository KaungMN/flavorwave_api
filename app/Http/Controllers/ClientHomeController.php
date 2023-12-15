<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClientHomeController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('CustomerAuth');
    // }
    // home page
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();

        // $pw = Hash::make('123456');
        // return $pw;
        if (!$products) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found'
            ]);
        }

        return response()->json($products);
    }


    //
    //
    public function createOrder(Request $request)
    {
        $customer_id = auth()->guard('customer')->id();
        // $validation = $this->validation($request);
        // if ($validation->fails()) {
        //     return response()->json([
        //         'status' => 404,
        //         'message' => 'not_found'
        //     ]);
        // }

        $preorder = Order::create([
            'customer_id' => $request->customer_id,
            'products' => $request->input('products'),
            'quantity' => $request->quantity,
            'city' => $request->city,
            'township' => $request->township,
            'address' => $request->address,
            'orderType' => $request->orderType,
            'status' => $request->status,
            'remark' => $request->remark,
            'sub_total' => $request->totalPrice
        ]);


        return response()->json([

            'message' => 'success'
        ], 200);
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
