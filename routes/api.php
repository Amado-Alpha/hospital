<?php

use App\Http\Controllers\storeDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/requestservice/{bed_number}', [storeDataController::class, 'sendingRequest']);
