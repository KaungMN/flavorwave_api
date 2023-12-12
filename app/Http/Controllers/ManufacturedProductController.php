<?php

namespace App\Http\Controllers;

use App\Models\ManufacturedProduct;
use Illuminate\Http\Request;

class ManufacturedProductController extends Controller
{
    //
    public function index()
    {
        $manufact_products = ManufacturedProduct::orderBy('id', 'desc')->with('product', 'raw')->get();

        if (!$manufact_products) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found'
            ]);
        }

        return response()->json($manufact_products);
    }


    // store
    public function store(Request $request)
    {

        $validateData = $request->validate([
            'product_id' => 'required',
            'raw_material_id' => 'required',
            'product_price' => 'required',
            'total_quantity' => 'required',
            'release_date' => 'required',
        ]);


        $manufact_product = ManufacturedProduct::create($validateData);

        return response()->json($manufact_product);
    }


    // edit
    public function edit($id)
    {
        $manufact_product = ManufacturedProduct::where('id', $id)->with('product', 'raw')->first();

        if (!$manufact_product) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found'
            ]);
        }

        return response()->json($manufact_product);
    }



    // update
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'product_id' => 'required',
            'raw_material_id' => 'required',
            'product_price' => 'required',
            'total_quantity' => 'required',
            'release_date' => 'required',
        ]);

        $manufact_product = ManufacturedProduct::find($id);


        $manufact_product->update($validateData);


        if (!$manufact_product) {
            return response()->json([
                'status' => 200,
                'message' => 'something_wrong',
            ]);
        }


        return response()->json($manufact_product);
    }



    // delete
    public function destroy($id)
    {
        $manufact_product = ManufacturedProduct::find($id);
        if (!$manufact_product) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found',
            ]);
        }
        $manufact_product->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }
}
