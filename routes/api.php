<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth:sanctum');

//Route::middleware('auth:sanctum')->apiResource('users', ProductController::class);

Route::post('/users', [UserController::class, 'store']);

Route::middleware('auth:sanctum')->apiResource('products', ProductController::class);
