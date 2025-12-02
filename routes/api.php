<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\AssertionController;
use App\Http\Middleware\CheckApiKey;

// Rutas Públicas
Route::get('/badges', [BadgeController::class, 'index']); // Reemplaza api/badges/index.php
Route::get('/assertions/{id}', [AssertionController::class, 'show']); // Reemplaza api/assertions/get.php

// Rutas Protegidas (Requieren API Key)
Route::middleware([CheckApiKey::class])->group(function () {
    Route::post('/badges/create', [BadgeController::class, 'store']); // Reemplaza api/badges/create.php
    Route::post('/badges/issue', [AssertionController::class, 'store']); // Reemplaza api/badges/issue.php
});