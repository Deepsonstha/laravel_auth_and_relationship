<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MobileController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::post("/register", [AuthController::class, 'register']);
Route::post("/login", [AuthController::class, 'login']);
Route::post("/mobile", [MobileController::class, 'storeMobile']);
Route::post("/customer", [CustomerController::class, 'store']);
Route::get("/customer/mobile/{id}", [CustomerController::class, 'getCustomerModile']);
Route::get("/mobile/customer/{id}", [MobileController::class, 'getMoileCustomer']);

Route::controller(AuthController::class)->middleware('auth:api')->group(function () {
    Route::get("/getProfile", 'getProfile');
    Route::get("/getAllUser", 'getAllUser');
    Route::get("/logout", 'logout');

});
