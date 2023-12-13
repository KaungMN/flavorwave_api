<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\CustomerController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\Auth\StaffAuthController;
use App\Http\Controllers\ClientHomeController;
use App\Http\Controllers\SaleController;

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
Route::post('/staff-login', [StaffAuthController::class, 'login'])->name('staffLogin');
// Route::get('/staffs', [StaffAuthController::class, 'index'])->name('staffLogin');


// products
Route::get('/product', [ClientHomeController::class, 'index']);
Route::get('/orders', [SaleController::class, 'index']);


// Route::post('/create-product', [ProductController::class, 'index']);

// Route::get('/createorders', [ClientHomeController::class, 'index']);
Route::post('/createorders', [ClientHomeController::class, 'createOrder']);
