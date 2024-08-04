<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UmrahController;
use App\Http\Controllers\OtomotifController;
use App\Http\Controllers\PropertiController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('welcome');

Route::prefix('umrah')->name('umrah.')->group(function () {
    Route::get('/', [UmrahController::class, 'index'])->name('index');
    Route::get('/create', [UmrahController::class, 'create'])->name('create');
    Route::post('/', [UmrahController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [UmrahController::class, 'edit'])->name('edit');
    Route::put('/{id}', [UmrahController::class, 'update'])->name('update');
    Route::delete('/{id}', [UmrahController::class, 'destroy'])->name('destroy');
    Route::put('/{id}/change-status', [UmrahController::class, 'changeStatus'])->name('changeStatus');
    Route::get('/{id}/spesifikasi', [UmrahController::class, 'spesifikasi'])->name('spesifikasi');
});

Route::prefix('otomotif')->name('otomotif.')->group(function () {
    Route::get('/', [OtomotifController::class, 'index'])->name('index');
    Route::get('/create', [OtomotifController::class, 'create'])->name('create');
    Route::post('/', [OtomotifController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [OtomotifController::class, 'edit'])->name('edit');
    Route::put('/{id}', [OtomotifController::class, 'update'])->name('update');
    Route::delete('/{id}', [OtomotifController::class, 'destroy'])->name('destroy');
    Route::put('/{id}/change-status', [OtomotifController::class, 'changeStatus'])->name('changeStatus');
    Route::get('/{id}/spesifikasi', [OtomotifController::class, 'spesifikasi'])->name('spesifikasi');
});

Route::prefix('properti')->name('properti.')->group(function () {
    Route::get('/', [PropertiController::class, 'index'])->name('index');
    Route::get('/create', [PropertiController::class, 'create'])->name('create');
    Route::post('/', [PropertiController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [PropertiController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PropertiController::class, 'update'])->name('update');
    Route::delete('/{id}', [PropertiController::class, 'destroy'])->name('destroy');
    Route::put('/{id}/change-status', [PropertiController::class, 'changeStatus'])->name('changeStatus');
    Route::get('/{id}/spesifikasi', [PropertiController::class, 'spesifikasi'])->name('spesifikasi');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::middleware(['redirect.if.authenticated'])->group(function () {

        Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {

            Route::get('dashboard', function () {
                return view('admin.layouts.master');
            })->name('dashboard');

            Route::get('user', [AdminController::class, 'index'])->name('user');
            Route::post('user/changeRole/{id}', [AdminController::class, 'changeRole'])->name('user.changeRole');
            Route::post('user/changeSellerType/{id}', [AdminController::class, 'changeSellerType'])->name('user.changeSellerType');

            Route::get('input/input-umrah', function () {
                return view('admin.input.input-umrah');
            })->name('input.input-umrah');

            Route::prefix('umrah')->name('umrah.')->group(function () {
                Route::get('/', [UmrahController::class, 'index'])->name('index');
                Route::post('/', [UmrahController::class, 'store'])->name('store');
                Route::patch('/{id}/toggle-status', [UmrahController::class, 'toggleStatus'])->name('toggleStatus');
                Route::get('/{id}/edit', [UmrahController::class, 'edit'])->name('edit');
                Route::post('/{id}', [UmrahController::class, 'update'])->name('update');
                Route::delete('/{id}', [UmrahController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('otomotif')->name('otomotif.')->group(function () {
                Route::get('/', [OtomotifController::class, 'index'])->name('index');
                Route::get('/create', [OtomotifController::class, 'create'])->name('create');
                Route::post('/', [OtomotifController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [OtomotifController::class, 'edit'])->name('edit');
                Route::put('/{id}', [OtomotifController::class, 'update'])->name('update');
                Route::delete('/{id}', [OtomotifController::class, 'destroy'])->name('destroy');
                Route::put('/{id}/change-status', [OtomotifController::class, 'changeStatus'])->name('changeStatus');
            });

            Route::prefix('properti')->name('properti.')->group(function () {
                Route::get('/', [PropertiController::class, 'index'])->name('index');
                Route::get('/create', [PropertiController::class, 'create'])->name('create');
                Route::post('/', [PropertiController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [PropertiController::class, 'edit'])->name('edit');
                Route::put('/{id}', [PropertiController::class, 'update'])->name('update');
                Route::delete('/{id}', [PropertiController::class, 'destroy'])->name('destroy');
                Route::put('/{id}/change-status', [PropertiController::class, 'changeStatus'])->name('changeStatus');
            });
        });

        Route::middleware(['customer'])->prefix('customer')->name('customer.')->group(function () {
            Route::get('/dashboard', function () {
                return view('welcome');
            })->name('dashboard');

            Route::get('user', [AdminController::class, 'index'])->name('user');

            Route::get('input/input-umrah', function () {
                return view('admin.input.input-umrah');
            })->name('input.input-umrah');

            Route::prefix('umrah')->name('umrah.')->group(function () {
                Route::get('/', [UmrahController::class, 'index'])->name('index');
                Route::post('/', [UmrahController::class, 'store'])->name('store');
                Route::patch('/{id}/toggle-status', [UmrahController::class, 'toggleStatus'])->name('toggleStatus');
                Route::get('/{id}/edit', [UmrahController::class, 'edit'])->name('edit');
                Route::post('/{id}', [UmrahController::class, 'update'])->name('update');
                Route::delete('/{id}', [UmrahController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('otomotif')->name('otomotif.')->group(function () {
                Route::get('/', [OtomotifController::class, 'index'])->name('index');
                Route::get('/create', [OtomotifController::class, 'create'])->name('create');
                Route::post('/', [OtomotifController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [OtomotifController::class, 'edit'])->name('edit');
                Route::put('/{id}', [OtomotifController::class, 'update'])->name('update');
                Route::delete('/{id}', [OtomotifController::class, 'destroy'])->name('destroy');
                Route::put('/{id}/change-status', [OtomotifController::class, 'changeStatus'])->name('changeStatus');
                Route::get('/{id}/spesifikasi', [OtomotifController::class, 'spesifikasi'])->name('spesifikasi');
                Route::get('/{id}', [OtomotifController::class, 'show'])->name('otomotif.show');
            });

            Route::prefix('properti')->name('properti.')->group(function () {
                Route::get('/', [PropertiController::class, 'index'])->name('index');
                Route::get('/create', [PropertiController::class, 'create'])->name('create');
                Route::post('/', [PropertiController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [PropertiController::class, 'edit'])->name('edit');
                Route::put('/{id}', [PropertiController::class, 'update'])->name('update');
                Route::delete('/{id}', [PropertiController::class, 'destroy'])->name('destroy');
                Route::put('/{id}/change-status', [PropertiController::class, 'changeStatus'])->name('changeStatus');
            });
        });
    });
});

Route::get('auth/google', [GoogleController::class, 'googlepage']);
Route::get('auth/google/callback', [GoogleController::class, 'googlecallback']);
