<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function addToCart(Request $request)
    {
        $findProduct = Product::where('id', $request->id)->first();

        if (!$findProduct) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found',

            ]);
        }


        Cart::create([
            'customer_id' => 1,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);


        return response()->json([
            'status' => 200,
            'message' => 'cart_created'
        ]);
    }
}
