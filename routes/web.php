<?php

use App\Http\Controllers\BermainController;
use App\Http\Controllers\BimbelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\JournalController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => 'useradmin'], function() {
    Route::get('/dashboard' , [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('role')->name('role.')->group(function () {
        Route::get('/', [RoleController::class, 'list'])->name('list');
        Route::get('/add', [RoleController::class, 'add'])->name('add');
        Route::post('/add', [RoleController::class, 'insert'])->name('insert');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [RoleController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('delete');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'list'])->name('list');
        Route::get('/add', [UserController::class, 'add'])->name('add');
        Route::post('/add', [UserController::class, 'insert'])->name('insert');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [UserController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
    });

    Route::prefix('bermain')->name('bermain.')->group(function () {
        Route::get('/', [BermainController::class, 'index'])->name('index');
        Route::post('/', [BermainController::class, 'store'])->name('store');
        Route::post('/update-timer/{id}', [BermainController::class, 'updateTimer'])->name('update-timer');
        Route::delete('/{id}', [BermainController::class, 'destroy'])->name('destroy');
        Route::get('/search', [BermainController::class, 'search'])->name('search');
    });

    Route::prefix('bimbel')->name('bimbel.')->group(function () {
        Route::get('/', [BimbelController::class, 'index'])->name('index');
        Route::post('/store', [BimbelController::class, 'store'])->name('store');
        Route::get('/detail/{id}', [BimbelController::class, 'detail'])->name('detail');
        Route::delete('/destroy/{id}', [BimbelController::class, 'destroy'])->name('destroy');
        Route::get('/search', [BimbelController::class, 'search'])->name('search');
    });

    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
    Route::post('/layanan', [LayananController::class, 'submit'])->name('layanan.submit');

    Route::prefix('journal')->group(function () {
        Route::get('/', [JournalController::class, 'index'])->name('journal.index');
        Route::get('/{id}', [JournalController::class, 'show'])->name('journal.show');
        Route::post('/', [JournalController::class, 'store'])->name('journal.store');
        Route::put('/{id}', [JournalController::class, 'update'])->name('journal.update');
        Route::delete('/{id}', [JournalController::class, 'destroy'])->name('journal.destroy');
    });

});

require __DIR__.'/auth.php';

