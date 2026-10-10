<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RequestController as AdminRequestController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::resource('requests', RequestController::class);
});

Route::middleware(['auth', 'verified', 'role:manager,admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/requests', [AdminRequestController::class, 'index'])->name('requests.index');
        Route::get('/requests/{request}', [AdminRequestController::class, 'show'])->name('requests.show');
        Route::patch('/requests/{request}/approve', [AdminRequestController::class, 'approve'])->name('requests.approve');
        Route::patch('/requests/{request}/reject', [AdminRequestController::class, 'reject'])->name('requests.reject');
    });

require __DIR__.'/settings.php';
