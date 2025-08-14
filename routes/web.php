<?php

use App\Http\Controllers\BaseController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FaQController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransaksiController;
use App\Models\Review;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', [BaseController::class, 'home'])->name('home');
Route::view('/syarat-ketentuan', 'sk')->name('sk');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::post('pesan-tiket', [BaseController::class, 'pesanTiket'])->name('pesan-tiket');

    Route::resource('history', HistoryController::class);

    Route::resource('checkout', CheckoutController::class);

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('dashboard', [BaseController::class, 'dashboard'])->name('dashboard');
    Route::get('bussiness-config', [BaseController::class, 'config'])->name('config.index');
    Route::post('bussiness-config', [BaseController::class, 'storeConfig'])->name('config.store');

    Route::resource('transaksi', TransaksiController::class);

    Route::resource('faq', FaQController::class);
    Route::resource('review', ReviewController::class);
});

require __DIR__ . '/auth.php';
