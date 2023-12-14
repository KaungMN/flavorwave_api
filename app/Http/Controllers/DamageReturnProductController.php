<?php

namespace App\Http\Controllers;

use App\Models\DamageReturnProduct;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class DamageReturnProductController extends Controller
{
    public function index(){
        return DamageReturnProduct::filter(request(['name','price']))->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "product_id" => ['required'],
            "quantity" => ['required'],
            "stage" => ['required']
        ]);


        $datas = DamageReturnProduct::create($data);

        if ($datas['stage'] === "damage") {
            $updatedStockList = $this->damageProducts($datas);
            Warehouse::where('manufacture_product_id', $datas['product_id'])->update(['quantity' => $updatedStockList]);
        }

        if ($datas['stage'] === "return") {
            $this->returnProducts($datas);
            Warehouse::where('manufacture_product_id', $datas['product_id'])->update(['quantity' => $updatedStockList]);
        }

        return response()->json($datas);
    }

    private function damageProducts($data)
    {
        $stockList = 0;
        $required_stocks =  Warehouse::where('manufacture_product_id', $data['product_id'])->get();
        foreach ($required_stocks as $stock) {
            $stockList += $stock->quantity;
        }


        $updatedStockList = $stockList - $data['quantity'];
        return $updatedStockList;
    }

    private function returnProducts($data)
    {
        $stockList = 0;
        $required_stocks =  Warehouse::where('manufacture_product_id', $data['product_id'])->get();
        foreach ($required_stocks as $stock) {
            $stockList += $stock->quantity;
        }

        $updatedStockList = $stockList + $data['quantity'];
        return $updatedStockList;
    }
}
