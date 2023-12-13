<?php

namespace App\Http\Controllers;

use App\Models\ManufacturedProduct;
use App\Models\DamageReturnProduct;
use App\Models\Preorder;
use App\Models\Product;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    //
    public function getProductSellCount($id)
    {
        $totalSellCount = 0;

        $orderedProducts = Preorder::where('product_id', $id)->where('status', 'completed')->get();
        foreach ($orderedProducts as $p) {
            $totalSellCount += explode('_', $p->box_pcs)[0];
        }

        return response()->json($totalSellCount);
    }

    public function getProductTotalCount($id)
    {
        $totalCount = 0;
        $products = ManufacturedProduct::where('product_id', $id);
        foreach ($products as $p) {
            $totalCount += explode('_', $p->total_amount)[0];
        }

        return response()->json($totalCount);
    }

    public function getDamageAndReturnCount($id)
    {
        $totalDamageCount = 0;
        $totalReturnCount = 0;
        $getDamage = DamageReturnProduct::where('product_id', $id)->where('stage', 'damage')->get();
        $getReturn = DamageReturnProduct::where('product_id', $id)->where('stage', 'sale return')->get();

        foreach ($getDamage as $pD) {
            $totalDamageCount += $pD->quantity;
        }

        foreach ($getReturn as $pR) {
            $totalReturnCount += $pD->quantity;
        }


        return response()->json(['total_damage_count' => $totalDamageCount, 'total_saleReturn_count' => $totalReturnCount]);
    }

    public function getProductPricesChanges(Request $request)
    {
        $requiredProduct = ManufacturedProduct::where('released_date', $request->year)->where('product_id', $request->product_id)->get();
        $priceChanges = $requiredProduct[(sizeof($requiredProduct)) - 1]['product_price'] - $requiredProduct[0]['price'];
    }
}
