<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestTypeController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//Write a group of routes that will be protected by Sanctum
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/dashboard', function () {
        return response()->json(['message' => 'Dashboard accessed successfully!']);
    });
});

Route::apiResource('/requesttypes', RequestTypeController::class);

