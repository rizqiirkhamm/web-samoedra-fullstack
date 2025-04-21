<?php

use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;

// Public FAQ Routes
Route::get('/faq', [FaqController::class, 'index'])->name('faq.public');

// Admin FAQ Routes
Route::middleware(['auth', 'useradmin'])->group(function () {
    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('/', [FaqController::class, 'adminIndex'])->name('admin.index');
        Route::get('/create', [FaqController::class, 'create'])->name('create');
        Route::post('/', [FaqController::class, 'store'])->name('store');
        Route::get('/{faq}/edit', [FaqController::class, 'edit'])->name('edit');
        Route::put('/{faq}', [FaqController::class, 'update'])->name('update');
        Route::delete('/{faq}', [FaqController::class, 'destroy'])->name('destroy');
    });
});
