<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisterController::class, 'store']);
Route::get('/check-email/{email}', [RegisterController::class, 'checkEmail']);
Route::post('/login', [LoginController::class, 'check']);

Route::get('/items',[ItemController::class, 'index']);
Route::prefix('/item')->group( function() {
    Route::post('/store' , [ItemController::class , 'store']);
    Route::put('/{id}',[ItemController::class , 'update']);
    Route::delete('/{id}',[ItemController::class , 'destroy']);
});
