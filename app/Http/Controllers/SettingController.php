<?php

namespace App\Http\Controllers;

use App\Models\Setting;
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
}
