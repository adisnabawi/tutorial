<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Inspiring;

Route::get('/', function () {
    return response()->json(array("quote"=>Inspiring::quote()));
})->name('api.index');
