<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\RepairOrderController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post("/register", [UserController::class, "register"]);
Route::post("/login", [UserController::class, "login"]);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/createOrder', [RepairOrderController::class, 'store']);
    Route::get('/order/{order}', [RepairOrderController::class, 'show']);
    Route::get('/orders', [RepairOrderController::class, 'index']);
    Route::get('/device/{device}', [DeviceController::class, 'show']);
    Route::get('/devices', [DeviceController::class, 'index']);
    Route::resource('/services', ServiceController::class);
});