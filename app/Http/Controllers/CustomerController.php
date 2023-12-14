<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function getCus(){
        $customers = Customer::orderBy("created_at","desc")->get();
        return response()->json($customers,200);
    }

    public function showCus($id){
        $customer = Customer::find($id);
        return response()->json($customer);
    }
}
