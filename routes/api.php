<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ClientHomeController;
use App\Http\Controllers\Auth\StaffAuthController;
use App\Http\Controllers\Auth\CustomerAuthController;




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

Route::post('/client-register', [CustomerAuthController::class, 'register'])->name('customerRegister');
Route::post('/client-login', [CustomerAuthController::class, 'login'])->name('customerLogin');
Route::post('/client-logout', [CustomerAuthController::class, 'logout'])->name('customerLogout');


// staff_auth
Route::post('/staff-register', [StaffAuthController::class, 'register'])->name('staffRegister');
Route::post('/staff-login', [StaffAuthController::class, 'login'])->name('staffLogin');
Route::post('/staff-logout', [StaffAuthController::class, 'logout'])->name('staffLogin');

Route::get('/product', [ClientHomeController::class, 'index']);

// customer_auth
Route::group(['middleware' => 'CustomerAuth'], function () {
    Route::post('/createorders', [ClientHomeController::class, 'createOrder']);
});


Route::group(['middleware' => 'CheckStaffAuthentication'], function () {

    // get staff
    Route::get('/staffs', [StaffController::class, 'getStaffs'])->name('staffs');


    // products
    Route::get('/orders', [SaleController::class, 'index']);


    // Route::post('/create-product', [ProductController::class, 'index']);

    // Route::get('/createorders', [ClientHomeController::class, 'index']);
});
