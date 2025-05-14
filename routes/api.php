<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;

Route::prefix('places')->group(function () {
    Route::get('/', [PlaceController::class, 'index']);
});
