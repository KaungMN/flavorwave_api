<?php

namespace App\Http\Controllers;

use App\Models\Preorder;
use Illuminate\Http\Request;

class PreorderController extends Controller
{
    public function index()
    {
        $preorders = Preorder::all();
        return response()->json($preorders);
    }

    // Create a new preorder
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|integer',
            'product_id' => 'required|integer',
            'box_pcs' => 'required|integer|min:1',
            'slug' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'township' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'orderType' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'remark' => 'nullable|string|max:255',
            
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
        $validatedData = $request->validate([
            'customer_id' => 'required|integer',
            'product_id' => 'required|integer',
            'box_pcs' => 'required|integer|min:1',
            'slug' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'township' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'orderType' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'remark' => 'nullable|string|max:255',
           
        ]);

        $preorder = Preorder::findOrFail($id);
        $preorder->update($validatedData);

        return response()->json($preorder, 200);
    }

   
    public function destroy($id)
    {
        $preorder = Preorder::findOrFail($id);
        $preorder->delete();

        return response()->json('Preorder deleted successfully', 200);
    }


}
