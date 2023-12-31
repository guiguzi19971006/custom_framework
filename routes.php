<?php

use Routes\Route;
use App\Controllers\ProductController;

Route::get('/products', ['controller' => ProductController::class, 'method' => 'index']);
Route::get('/products/{product_id}', ['controller' => ProductController::class, 'method' => 'show']);
