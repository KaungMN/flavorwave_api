<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getCus(){
        $customers = Customer::latest()->paginate(20);
        return response()->json($customers);
    }

    public function storeCus(Request $request){

    }
}
