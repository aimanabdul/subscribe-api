<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscribeController;
use App\Http\Middleware\Cors;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('subscribe', SubscribeController::class)->middleware(Cors::class);