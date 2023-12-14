<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RawMaterial;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function filter(){
        return Product::filter(request(['name','price']))->get();
    }



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
                $image = $request->file('photo');
                $image_name = uniqid() . ($image->getClientOriginalName());
                $image->move(public_path('/img/product'), $image_name);


                // $product = Product::create($validateData);

                Product::create([
                        'name' => $request->product,
                        'price' => $request->price,
                        'photo' => $image_name,
                        'description' => $request->description
                ]);

                return response()->json([
                        'message' => 'success'
                ]);
        }
}
