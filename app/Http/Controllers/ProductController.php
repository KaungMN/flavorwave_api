<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

        public function index()
        {
                // $raw_materials = RawMaterial::orderBy('id', 'desc')->get();
                $product = Product::orderBy('id', 'desc')->with('raw')->get();

                return response()->json($product);
        }


        // store
        public function store(Request $request)
        {

                $validator = $this->validation($request);

                if ($validator->fails()) {
                        return response()->json([
                                'message' => 'required'
                        ]);
                }

                // image upload
                $image = $request->file('photo');
                $image_name = uniqid() . ($image->getClientOriginalName());
                $image->storeAs('public/images/product', $image_name);

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


        // update
        public function update(Request $request, $id)
        {
                $product = Product::where('id', $id)->first();

                if (!$product) {
                        return response()->json([
                                'status' => 404,
                                'message' => 'not_found'
                        ]);
                }

                $file = $request->file('photo');
                if ($file) {
                        $image_name = uniqid() . $file->getClientOriginalName();
                        $file->storeAs('public/images/product', $image_name);
                } else {
                        $image_name = $product->image;
                }

                $product->update([
                        'name' => $request->product,
                        'price' => $request->price,
                        'photo' => $image_name,
                        'description' => $request->description
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
                        'name' => 'required',
                        'price' => 'required',
                        'photo' => 'required',
                        'description' => 'required',
                ]);
        }
}
