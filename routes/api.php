<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstoqueController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', [EstoqueController::class, 'index']);
Route::get('/product/{îd}', [EstoqueController::class, 'show']);
Route::post('/product', [EstoqueController::class, 'store']);
Route::put('/product/{id}', [EstoqueController::class, 'update']);
Route::delete('/product/{id}', [EstoqueController::class, 'destroy']);
