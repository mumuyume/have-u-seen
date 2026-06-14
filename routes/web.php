<?php

use App\Http\Controllers\ImpressionController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Route;

# ログイン不要アドレス
Route::get('/', [WorkController::class, 'index'])->name('works.index');
Route::get('/search', [WorkController::class, 'search'])->name('works.search');
Route::get('/{work}', [WorkController::class, 'show'])->name('works.show');

#ログイン必須アドレス
Route::middleware('auth')->group(function () {
    Route::get('/{work}/impression', [ImpressionController::class, 'edit'])->name('impressions.edit');
    Route::put('/{work}/impression', [ImpressionController::class, 'update'])->name('impressions.update');
    Route::delete('/{work}/impression', [ImpressionController::class, 'destroy'])->name('impressions.destroy');

    Route::get('/mypage', [MypageController::class, 'show'])->name('mypage');
});


/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
