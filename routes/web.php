<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

use App\Http\Controllers\ApiKeyController;

use App\Http\Controllers\ReportController;



Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('api_keys', ApiKeyController::class)->except(['show', 'edit', 'update']);
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
});

