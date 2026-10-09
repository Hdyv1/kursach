<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\RepairOrderController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RepairOrderServiceController;
use App\Http\Controllers\RepairOrderReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post("/register", [UserController::class, "register"]);
Route::post("/login", [UserController::class, "login"]);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/createOrder', [RepairOrderController::class, 'store']);
    Route::post('/updateOrder/{order}', [RepairOrderController::class, 'update']);
    Route::get('/order/{order}', [RepairOrderController::class, 'show']);
    Route::get('/orders', [RepairOrderController::class, 'index']);
    Route::get('/device/{device}', [DeviceController::class, 'show']);
    Route::get('/devices', [DeviceController::class, 'index']);
    Route::resource('/services', ServiceController::class);
    Route::post('/orderServices/{order}/{service}', [RepairOrderServiceController::class, 'serviceAdd']);
    Route::delete('/orderServices/{order}/{service}', [RepairOrderServiceController::class, 'destroy']);
    Route::post('/review/{order}', [RepairOrderReviewController::class, 'store']);
    Route::get('/reviews/{order}', [RepairOrderReviewController::class, 'index']);
    Route::post('/logout', [UserController::class, 'logout']);
});