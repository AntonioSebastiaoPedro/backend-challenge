<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;

Route::prefix('places')->group(function () {
    Route::get('/', [PlaceController::class, 'index']);
    Route::get('/{id}', [PlaceController::class, 'show']);
    Route::post('/', [PlaceController::class, 'store']);
    Route::put('/{id}', [PlaceController::class, 'update']);
    Route::delete('/{id}', [PlaceController::class, 'destroy']);
});
