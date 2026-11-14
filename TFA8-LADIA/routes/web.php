<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Protected routes (login required)
|--------------------------------------------------------------------------
| Anyone who is not logged in is redirected to the login page by the
| `auth` middleware.
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard', [
        'customerCount' => Customer::count(),
        'userCount' => User::count(),
    ]))->name('dashboard');

    // One call registers all seven conventional routes for each resource:
    // index, create, store, show, edit, update, destroy.
    Route::resource('customers', CustomerController::class);
    Route::resource('users', UserController::class);

    // Profile of the currently logged-in user (from Breeze).
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Login, registration, logout and password-reset routes (Breeze).
require __DIR__.'/auth.php';
