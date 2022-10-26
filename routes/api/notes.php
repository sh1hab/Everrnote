<?php

use App\Http\Controllers\Api\NoteController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group( function ($router) {
    $router->resource('/notes', NoteController::class)->except(['edit']);
});


