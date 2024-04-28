<?php

use App\Supports\Route;
use App\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product_id}', [ProductController::class, 'show']);
