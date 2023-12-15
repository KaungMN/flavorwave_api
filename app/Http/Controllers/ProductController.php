<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RawMaterial;
use Illuminate\Http\Request;

class ProductController extends Controller
{

        public function index()
        {
                // $raw_materials = RawMaterial::orderBy('id', 'desc')->get();
                $product = Product::orderBy('id', 'desc')->with('raw')->get();
                // return $product;
                return response()->json($product);
        }


        // store
        public function store(Request $request)
        {


                // image upload
            if($request->file('photo')) {
                $image = $request->file('photo');
                $image_name = uniqid() . ($image->getClientOriginalName());
                $image->move(public_path('/img/product'), $image_name);
                $request['photo'] = $image_name;
            }



                // $product = Product::create($validateData);

                Product::create([
                         'name' => $request->name,
                        'price' => $request->price,
                        'description' => $request->description
                ]);

                return response()->json([
                        'message' => 'success'
                ]);
        }
}
