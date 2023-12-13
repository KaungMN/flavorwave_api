<?php

namespace App\Http\Controllers;

use App\Models\Preorder;
use Illuminate\Http\Request;

class PreorderController extends Controller
{
    public function index(){
        return Preorder::filter(request(['status','customer','product']))->get();
    }

    public function getPreorders()
    {
        $preorders = Preorder::orderBy('id', 'desc')->get();
        return response()->json($preorders);
    }

    // Create a new preorder
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'customer_id' => 'required',
            'box_pcs' => 'required',
            'city' => 'required',
            'township' => 'required',
            'address' => 'required',
            'orderType' => 'required',
            'status' => 'required',
            'remark' => 'nullable',
            'delivery_date'=>'nullable'
        ]);

        $preorder = Preorder::create($validatedData);
        return response()->json($preorder, 201);
    }


    public function show($id)
    {
        $preorder = Preorder::findOrFail($id);
        return response()->json($preorder);
    }


    public function update(Request $request, $id)
    {
        // $validatedData = $request->validate([
        //     'product_id' => 'required',
        //     'customer_id' => 'required',
        //     'box_pcs' => 'required',
        //     'city' => 'required',
        //     'township' => 'required',
        //     'address' => 'required',
        //     'orderType' => 'required',
        //     'remark' => 'nullable',
        //     'subtotal'=>
        // ]);

        $preorder = Preorder::findOrFail($id);
        $preorder->update($request->all());

        return response()->json($preorder, 200);
    }

    public function destroy($id)
    {
        $preorder = Preorder::findOrFail($id);
        $preorder->delete();

        return response()->json('Preorder deleted successfully', 200);
    }

}
