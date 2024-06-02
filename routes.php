<?php

use App\Supports\Route;
use App\Controllers\HomeController;
use App\Controllers\ProductController;
use App\Controllers\UserController;

Route::middleware(['csp'])->get('', [HomeController::class, 'index']);
Route::middleware(['csp'])->get('/products', [ProductController::class, 'index']);
Route::middleware(['csp'])->get('/products/{product_id}', [ProductController::class, 'show']);

Route::middleware(['csp'])->get('/users/register', [UserController::class, 'register']);
Route::post('/users/register', [UserController::class, 'registerProcess']);
Route::middleware(['csp'])->get('/users/verify/{token}', [UserController::class, 'verify']);
