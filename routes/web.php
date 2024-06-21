<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'redirect.if.authenticated'  // Middleware untuk redirect berdasarkan role
])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.layouts.master');
        })->name('admin.dashboard');

        Route::get('/admin/user', [AdminController::class, 'index'])->name('admin.user');
        Route::post('/admin/user/change-role/{id}', [AdminController::class, 'changeRole'])->name('admin.user.changeRole');

        Route::get('/admin/umrah', function () {
            return view('admin.umrah');
        })->name('admin.umrah');

        Route::get('/admin/otomotif', function () {
            return view('admin.otomotif');
        })->name('admin.otomotif');

        Route::get('/admin/properti', function () {
            return view('admin.properti');
        })->name('admin.properti');
    });

    Route::middleware(['customer'])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });
});

Route::get('auth/google', [GoogleController::class, 'googlepage']);
Route::get('auth/google/callback', [GoogleController::class, 'googlecallback']);
