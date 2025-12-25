<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index']);
Route::get('/project/{slug}', [PortfolioController::class, 'show'])->name('project.show');
Route::post('/contact', [PortfolioController::class, 'storeContact'])->name('contact.store');
