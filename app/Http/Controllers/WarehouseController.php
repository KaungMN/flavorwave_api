<?php

namespace App\Http\Controllers;

use App\Models\WarehouseProduct;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    //
    public function index()
    {
        $products = WarehouseProduct::orderBy('id', 'desc')->with('warehouse')->get();
        return response()->json($products);
    }


    // store products to warehouse
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'line' => 'required',
            'warehouse_id' => 'required',
            'expire_date' => 'required',
            'manufactured_product_id' => 'required',
        ]);


        $product = WarehouseProduct::create($validateData);

        return response()->json($product);
    }


    // edit
    public function edit(Request $request, $id)
    {
        $warehouse_product = WarehouseProduct::where('id', $id)->first();

        if (!$warehouse_product) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found'
            ]);
        }

        return response()->json($warehouse_product);
    }



    // update
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'line' => 'required',
            'warehouse_id' => 'required',
            'expire_date' => 'required',
            'manufactured_product_id' => 'required',
        ]);


        $warehouse_product = WarehouseProduct::find($id);

        if (!$warehouse_product) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found',
            ]);
        }

        $warehouse_product->update($validateData);
    }

    // delete
    public function destroy($id)
    {
        $warehouse_product = WarehouseProduct::find($id);
        if (!$warehouse_product) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found',
            ]);
        }
        $warehouse_product->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }
}
