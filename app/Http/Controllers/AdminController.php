<?php

namespace App\Http\Controllers;

use App\Models\Preorder;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getProductSellCount($id){
        $totalSellCount = 0;

        $orderedProducts = Preorder::where('product_id',$id)->where('status','completed')->get();
        foreach($orderedProducts as $p){
            $totalSellCount += explode('_',$p->box_pcs)[0];
        }

        return response()->json($totalSellCount);

    }

    public function getProductTotalCount($id){
        $totalCount = 0;
        $products = ManufacturedProduct::where('product_id',$id);
        foreach($products as $p){
            $totalCount += explode('_',$p->$total_amount)[0];
        }

        return response()->json($totalCount);
    }

    public function getDamageAndReturnCount(){

    }

    public function getProductPricesChanges(){

    }
}
