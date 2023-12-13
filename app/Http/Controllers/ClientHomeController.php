<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ClientHomeController extends Controller
{
    public function index(){
        return Product::filter(request(['name','price']))->get();
    }
}
