<?php

use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\PreorderController;
use App\Http\Controllers\TruckController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('api/trucks',[TruckController::class,'index'])->name('trucks');
Route::post('api/trucks', [TruckController::class, 'create'])->name('trucks.create');
Route::get('api/trucks/{id}', [TruckController::class, 'show'])->name('trucks.show');
Route::put('api/trucks/{id}', [TruckController::class, 'update'])->name('trucks.update');
Route::delete('api/trucks/{id}', [TruckController::class, 'delete'])->name('trucks.delete');

Route::get('api/deliveries',[DeliveryController::class,'index'])->name('deliveries');
Route::post('api/deliveries', [DeliveryController::class, 'create'])->name('deliveries.create');
Route::get('api/deliveries/{id}',[ DeliveryController::class, 'show'])->name('deliveries.show');
Route::put('api/deliveries/{id}', [DeliveryController::class, 'update'])->name('deliveries.update');
Route::delete('api/deliveries/{id}', [DeliveryController::class, 'delete'])->name('deliveries.delete');

Route::get('api/preorders',[PreorderController::class,'index'])->name('preorders');
Route::post('api/preorders', [PreorderController::class, 'create'])->name('preorders.create');
Route::get('api/preorders/{id}',[PreorderController::class, 'show'])->name('preorders.show');
Route::put('api/preorders/{id}', [PreorderController::class, 'update'])->name('preorders.update');
Route::delete('api/preorders/{id}', [PreorderController::class, 'delete'])->name('preorders.delete');




