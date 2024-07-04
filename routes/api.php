<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::controller(AuthController::class)->group(function () {
    Route::get("/getProfile", 'getProfile');
    Route::get("/getAllUser", 'getAllUser');
    Route::get("/logout", 'logout');

});

//! role and permission
Route::get("permission", [PermissionController::class, 'getPermission']);
Route::post("permission", [PermissionController::class, 'createPermission']);
Route::put("permission/{id}", [PermissionController::class, 'editPermission']);
Route::delete("permission/{id}", [PermissionController::class, 'deletePermission']);

Route::get("role", [RoleController::class, 'getRole']);
Route::post("role", [RoleController::class, 'createRole']);
Route::put("role/{id}", [RoleController::class, 'editRole']);
Route::delete("role/{id}", [RoleController::class, 'deleteRole']);

//! create user
Route::post("createuser", [UserController::class, 'createUser']);
Route::get("getSingleUserWithRoles/{id}", [UserController::class, 'getSingleUserWithRoles']);
Route::get("checkfuntion", [UserController::class, 'checkfuntion']);

//! image crud
Route::post("createPost", [PostController::class, 'create']);
