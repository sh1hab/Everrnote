<?php

use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group( function ($router) {
    $router->resource('/contacts', TransactionController::class);
});



