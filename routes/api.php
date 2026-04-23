<?php

use App\Http\Controllers\Api\ItemController;
use Illuminate\Support\Facades\Route;


Route::prefix('items')->controller(ItemController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{item}', 'show');
    Route::post('/{item}', 'update');
    Route::delete('/{item}', 'destroy');
});