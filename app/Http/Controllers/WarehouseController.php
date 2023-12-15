<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    //
    public function index()
    {
        $warehouse = Warehouse::orderBy('id', 'desc')->get();
        return response()->json($warehouse);
    }


    // store products to warehouse
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            // 'manufactured_product_id' => 'required',
        ]);


        $warehouse = Warehouse::create($validateData);

        return response()->json($warehouse);
    }


    // edit
    // public function edit(Request $request, $id)
    // {
    //     $warehouse_product = WarehouseProduct::where('id', $id)->first();

    //     if (!$warehouse_product) {
    //         return response()->json([
    //             'status' => 404,
    //             'message' => 'not_found'
    //         ]);
    //     }

    //     return response()->json($warehouse_product);
    // }



    // update
    public function update(Request $request, $id)
    {
        // $validateData = $request->validate([
        //     'line' => 'required',
        //     'warehouse_id' => 'required',
        //     'expire_date' => 'required',
        //     'manufactured_product_id' => 'required',
        // ]);


        $warehouse = Warehouse::find($id);

        if (!$warehouse) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found',
            ]);
        }

        $warehouse->update($request->all());
    }

    // delete
    public function destroy($id)
    {
        $warehouse = Warehouse::find($id);
        if (!$warehouse) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found',
            ]);
        }
        $warehouse->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }
}
