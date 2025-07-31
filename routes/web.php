<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/personal', [ProfileController::class, 'updatePersonal'])->name('profile.update.personal');
Route::resource('accounts', AccountController::class)
    ->middleware(['auth', 'verified']);
Route::resource('categories', App\Http\Controllers\CategoryController::class)
    ->middleware(['auth', 'verified']);
Route::resource('transactions', App\Http\Controllers\TransactionController::class)
    ->middleware(['auth', 'verified']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/show', [DashboardController::class, 'show'])->name('dashboard.show');
});

require __DIR__.'/auth.php';
