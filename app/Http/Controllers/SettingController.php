<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Product;
use App\Models\ProductProfitSummary;
use Illuminate\Http\Request;
class SettingController extends Controller
{
    public function getDepartmentsBudgetsPerYear(Request $request)
    {
        $getBudgets = Setting::get();
        if ($getBudgets) {
            return response()->json($getBudgets);
        } else {
            return response()->json(['message' => 'Something went wrong'], 400);
        }
    }

    public function store(Request $request){
        $data = Setting::create($request->all());
        return response()->json($data);
    }


    public function getProductProfitSummary(Request $request)
    {

        $selected_year = !empty($request->target_year) ? $request->target_year : date('Y');

        $select_fields = [
            'products.name as product_name',
            'product_profit_summary.produced_count',
            'product_profit_summary.sold_count',
            'product_profit_summary.cancel_count',
            'product_profit_summary.total_sale_amount',
            'product_profit_summary.popularity',
            'product_profit_summary.target_year'
        ];
        $yearly_data = ProductProfitSummary::select($select_fields)
                                            ->leftjoin('products','products.id', 'product_profit_summary.product_id')
                                            ->where('product_profit_summary.target_year', $selected_year)
                                            ->whereNull('products.deleted_at')
                                            ->orderby('product_profit_summary.product_id')
                                            ->get();

        return response()->json($yearly_data);

    }
}
