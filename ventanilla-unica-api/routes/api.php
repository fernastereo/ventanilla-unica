<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeticionController;
use App\Http\Controllers\TipopeticionController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//Write a group of routes that will be protected by Sanctum
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/dashboard', function () {
        return response()->json(['message' => 'Dashboard accessed successfully!']);
    });
});

Route::apiResource('peticions', PeticionController::class);
Route::get('/tipopeticions', [TipopeticionController::class, 'index']);

Route::get('/test', function () {
    return response()->json(['message' => 'Test performed successfully!']);
});