<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ("not found");
})->name('home');

