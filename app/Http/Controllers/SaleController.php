<?php

namespace App\Http\Controllers;

use App\Models\Preorder;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class SaleController extends Controller
{
    //
    public function index()
    {
        $preorders = Preorder::orderBy('id', 'desc')->with('customer')->get();
        return $preorders;
        if (!$preorders) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found'
            ]);
        }

        return response()->json($preorders);
    }

    // change status
    public function changeStatus(Request $request)
    {
        $data = Preorder::where('id', $request->id)->first();

        if (!$data) {
            return response()->json([
                'status' => 500,
                'message' => 'internal_server'
            ]);
        }

        $data->update([
            'status' => $request->status
        ]);

        // if($data->status == 'confirm'){

        // }

        return response()->json([
            'status' => 200,
            'message' => 'success'
        ]);
    }
}
