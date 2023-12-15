<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\StaffController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ClientHomeController;
use App\Http\Controllers\DamageReturnProductController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ManufacturedProductController;
use App\Http\Controllers\PreorderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SettingController;


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


// staff_auth
Route::post('/staff-register', [StaffAuthController::class, 'register'])->name('staffRegister');
Route::post('/staff-login', [StaffAuthController::class, 'login'])->name('staffLogin');

Route::get('/product', [ClientHomeController::class, 'index']);

// customer_auth
Route::group(['middleware' => 'CustomerAuth'], function () {
    Route::post('/createorders', [ClientHomeController::class, 'createOrder']);
    Route::post('/client-logout', [CustomerAuthController::class, 'logout'])->name('customerLogout');
});



// staff middleware
Route::group(['middleware' => 'CheckStaffAuthentication'], function () {

    Route::post('/staff-logout', [StaffAuthController::class, 'logout'])->name('staffLogout');

    Route::get('/staffs', [StaffController::class, 'getStaffs'])->name('staffs');

    Route::get('/get-preorders', [SaleController::class, 'getPreorders']);


    // get staff
});

    // products
    Route::get('/orders', [SaleController::class, 'index']);

});
    // Route::post('/create-product', [ProductController::class, 'index']);

// Route::post('/create-orders', [ClientHomeController::class, 'createOrder']);

Route::get('/get-budgets', [SettingController::class, 'getDepartmentsBudgetsPerYear']);

//preorder(sale)
Route::post('/post-preorder/{preOrderId}', [SaleController::class, 'storePreorder']);
Route::post('/change-status', [SaleController::class, 'changeStatus']);


//factory
Route::get('/get-products',[ManufacturedProductController::class,'index']);
Route::post('/post-product',[ManufacturedProductController::class,'store']);
Route::patch('/edit-product/{id}',[ManufacturedProductController::class,'edit']);
Route::get('/get-products/{id}',[ManufacturedProductController::class,'show']);
Route::delete('/delete-product/{id}',[ManufacturedProductController::class,'destroy']);

//sale confirm and update maufactured product list
Route::post('/order-confirm', [ManufacturedProductController::class, 'checkValidAndConfirmPreorder']);

//check stock
Route::get('/check-stock', [ManufacturedProductController::class, 'checkStock']);

//admin product
// Route::get('/get-sell-count',[AdminController::class,'getProductSellCount']);
Route::post('/get-total-count/{product_id}/{targetYear}',[AdminController::class,'getProductTotalCount']);
Route::post('/get-damage-return-count',[AdminController::class,'getDamageAndReturnCount']);
Route::post('/get-product-prices-change/{product_id}',[AdminController::class,'getProductPricesChanges']);

//get product
Route::post('/get-product',[ProductController::class,'getProduct']);


//setting
Route::get('/get-departments-budgets', [SettingController::class, 'getDepartmentsBudgetsPerYear']);
Route::post('/store-budgets', [SettingController::class, 'store']);



//get damage products
Route::get('/damage-return-products', [DamageReturnProductController::class, 'index']);
Route::post('/damage-return-products', [DamageReturnProductController::class, 'store']);


//delivery
Route::get('/get-delivery', [DeliveryController::class, 'index']);
Route::post('/post-delivery', [DeliveryController::class, 'store']);
Route::get('/order-success', [DeliveryController::class, 'orderSuccess']);
Route::post('/change-deli-status', [DeliveryController::class, 'changeStatus']);

//pre-order
Route::get('/getpreorders', [SaleController::class, 'getPreorders']);
Route::post('/store-preorders', [OrderController::class, 'store']);
Route::get('/show-preorder', [OrderController::class, 'show']);
Route::patch('/update-preorder/{id}', [OrderController::class, 'update']);
Route::delete('/delete-preorder/{id}', [OrderController::class, 'destroy']);

//product
Route::get('/get-products',[ProductController::class,'index']);
Route::post('/post-products',[ProductController::class,'store']);
Route::get('/get-product/{name}',[ProductController::class,'show']);
// Route::patch('/update-product/{id}',[ProductController::class,'update']);
// Route::delete('/delete-product/{id}',[ProductController::class,'destroy']);


//raw materials
Route::get('/get-raw-materials', [OrderController::class, 'getPreorders']);
Route::post('/store-raw-materials', [OrderController::class, 'store']);
Route::get('/show-preorder', [OrderController::class, 'showRaw']);
Route::patch('/update-preorder/{id}', [OrderController::class, 'updateRaw']);
Route::delete('/delete-preorder/{id}', [OrderController::class, 'destroy']);

//staff
Route::get('/get-staffs',[StaffController::class,'getStaffs']);
Route::post('/store-staffs',[StaffController::class,'storeStaffs']);
Route::get('/show-staff',[StaffController::class,'showStaff']);
Route::put('/update-staff/{id}',[StaffController::class,'updateStaff']);
Route::delete('/delete-staff/{id}',[StaffController::class,'deleteStaff']);

//truck
Route::get('/get-trucks', [TruckController::class, 'getTrucks']);
Route::post('/store-truck', [TruckController::class, 'store']);
Route::get('/show-truck', [TruckController::class, 'show']);
Route::patch('/update-truck/{id}', [TruckController::class, 'update']);
Route::delete('/delete-truck/{id}', [TruckController::class, 'destroy']);

//warehouse
Route::get('/get-warehouses',[OrderController::class,'index']);
Route::post('/store-warehouse',[OrderController::class,'store']);
Route::get('/show-truck',[OrderController::class,'show']);
Route::patch('/update-warehouse/{id}',[OrderController::class,'edit']);
Route::delete('/delete-warehouse/{id}',[OrderController::class,'destroy']);

//role
Route::get('/get-role/{id}',[RoleController::class,'getRole']);

//department
Route::get('/get-department/{id}',[DepartmentController::class,'getDepartment']);