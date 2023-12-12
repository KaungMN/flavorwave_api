<?php

use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });




// customer_auth
// register
Route::post('/client-register', [CustomerAuthController::class, 'register'])->name('customerRegister');

// login
Route::post('/client-login', [CustomerAuthController::class, 'login'])->name('customerLogin');


// products
Route::get('/products', [ProductController::class, 'index'])->name('products');


// cart
Route::get('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
