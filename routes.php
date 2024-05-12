<?php

use App\Supports\Route;
use App\Controllers\ProductController;

Route::middleware(['csp'])->get('/products', [ProductController::class, 'index']);
Route::middleware(['csp'])->get('/products/{product_id}', [ProductController::class, 'show']);
