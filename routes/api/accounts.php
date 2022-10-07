<?php

use App\Http\Controllers\Api\AccountController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group( function ($router) {
    $router->resource('/accounts', AccountController::class)->except(['edit']);
});


