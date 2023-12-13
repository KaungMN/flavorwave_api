<?php

namespace App\Http\Controllers;

use App\Models\WarehouseProduct;
use Illuminate\Http\Request;

class WarehouseProductController extends Controller
{
    public function index(){
        return WarehouseProduct::filter(request(['search','raw']))->get();
    }
    //
}
