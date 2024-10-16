<?php

use App\Http\Controllers\LogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    return response('Asmoro Rest API');
});

// Post Log ESP
// Route::post('log', [LogController::class, 'store']);
Route::get('log', [LogController::class, 'store']);