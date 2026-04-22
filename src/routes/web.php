<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\DashboardController;

// Начална страница - последните 5 ремонта
Route::get('/', function () {
    $recentRepairs = \App\Models\Repair::with(['car', 'service'])
        ->latest()
        ->limit(5)
        ->get();
    return view('welcome', compact('recentRepairs'));
});

// Автентикация (Laravel Breeze/генерирани)
Auth::routes();

// Защитени маршрути - само за влезли потребители
Route::middleware(['auth'])->group(function () {

    // Табло
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Коли (CRUD)
    Route::resource('cars', CarController::class);

    // Услуги (CRUD) - само за администратори
    Route::resource('services', ServiceController::class);

    // Ремонти (CRUD)
    Route::resource('repairs', RepairController::class);

});
