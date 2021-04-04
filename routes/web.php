<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/add-perfume', [DashboardController::class, 'create'])->name('create');
Route::post('/add-perfume', [DashboardController::class, 'store'])->name('store');

Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
Route::post('/stock/add', [StockController::class, 'store'])->name('stock.store');

//Route::get('/', function () { return view('welcome'); });
