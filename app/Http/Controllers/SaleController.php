<?php

namespace App\Http\Controllers;

use App\Models\Preorder;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    //
    public function index()
    {
        $preorders = Preorder::orderBy('id', 'desc')->get();

        if (!$preorders) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found'
            ]);
        }

        return response()->json($preorders);
    }
}
