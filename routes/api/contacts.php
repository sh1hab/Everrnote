<?php

use App\Http\Controllers\Api\ContactController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group( function ($router) {
    $router->resource('/contacts', ContactController::class);
});



