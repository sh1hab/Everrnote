<?php

use App\Http\Controllers\Api\SurveyController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group( function ($router) {
    $router->resource('/surveys', SurveyController::class);
});
