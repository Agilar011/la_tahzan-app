<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UmrahController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'redirect.if.authenticated'
])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.layouts.master');
        })->name('admin.dashboard');

        Route::get('/admin/user', [AdminController::class, 'index'])->name('admin.user');
        Route::post('/admin/user/change-role/{id}', [AdminController::class, 'changeRole'])->name('admin.user.changeRole');


        Route::get('/admin/input/input-umrah', function () {
            return view('admin.input.input-umrah');
        })->name('admin.input.input-umrah');

        Route::prefix('admin/umrah')->name('admin.umrah.')->group(function () {
            Route::get('/', [UmrahController::class, 'index'])->name('index');
            Route::post('/', [UmrahController::class, 'store'])->name('store');
            Route::patch('/{id}/toggle-status', [UmrahController::class, 'toggleStatus'])->name('toggleStatus');
            Route::get('/{id}/edit', [UmrahController::class, 'edit'])->name('edit');
            Route::post('/{id}', [UmrahController::class, 'update'])->name('update');
            Route::delete('/{id}', [UmrahController::class, 'destroy'])->name('destroy');
        });


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
