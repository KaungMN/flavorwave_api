<?php

namespace App\Http\Controllers;

use App\Models\DamageReturnProduct;
use App\Models\ManufacturedProduct;
use App\Models\Preorder;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getProductSellCount(Request $request){
        $totalSellCount = 0;

        $orderedProducts = Preorder::where('product_id',$request->product_id)->where('status','completed')->get(); //year
        foreach($orderedProducts as $p){
            $totalSellCount += explode('_',$p->box_pcs)[0];
        }

        return response()->json($totalSellCount);

    }

    public function getProductTotalCount(Request $request){
        $totalCount = 0;
        $products = ManufacturedProduct::where('product_id',$request->product_id)->where('release_date',$request->targetYear)->get();
        foreach($products as $p){
            $totalCount += $p->total_quantity;
        }

        return response()->json($totalCount);
    }

    public function getDamageAndReturnCount($id){
        $totalDamageCount = 0;
        $totalReturnCount = 0;
        $getDamage = DamageReturnProduct::where('product_id',$id)->where('stage','damage')->get();
        $getReturn = DamageReturnProduct::where('product_id',$id)->where('stage','sale return')->get();

        foreach($getDamage as $pD){
            $totalDamageCount += $pD->quantity;
        }

        foreach($getReturn as $pR){
            $totalReturnCount += $pD->quantity;
        }


        return response()->json(['total_damage_count'=>$totalDamageCount,'total_saleReturn_count'=>$totalReturnCount]);
    }

    public function getProductPricesChanges(Request $request){
        $requiredProduct = ManufacturedProduct::where('released_date',$request->year)->where('product_id',$request->product_id)->get();
        $prices = [];
        foreach($requiredProduct as $product){
            array_push($prices,$product['product_price']);
        }
        return response()->json($prices);
    }
}
