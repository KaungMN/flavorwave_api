<?php

namespace App\Http\Controllers;

use App\Models\DamageReturnProduct;
use Illuminate\Http\Request;

class DamageReturnProductController extends Controller
{
    //
    public function index()
    {
        $products = DamageReturnProduct::orderBy('id', 'desc')->with('product')->get();

        if (!$products) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found'
            ]);
        }

        return response()->json($products);
    }



    // store
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'remark' => 'required',

        ]);
    }
}
