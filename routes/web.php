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
use App\Http\Controllers\EventController;
use App\Models\EventRegistrationModel;
use App\Http\Controllers\DaycareController;
use App\Http\Controllers\Frontend\ArtikelController;
use App\Http\Controllers\Frontend\DetailArtikelController;
use App\Http\Controllers\Frontend\DetailLayananController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Frontend\GaleriController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Frontend\ArticleController as FrontendArticleController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProgramController;
use App\Http\Controllers\Frontend\TentangController;
use App\Http\Controllers\StimulasiController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeContentController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\TentangController as AdminTentangController;
use App\Http\Controllers\TestimoniController;

// routes/web.php
Route::get('', [HomeController::class, 'index'])->name('home'); // Ganti 'welcome' menjadi 'home'


Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');
Route::get('/layanan', [ProgramController::class, 'index'])->name('program');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');


// Public routes (before auth middleware)
Route::get('/daftar', [LayananController::class, 'welcome'])->name('welcome');
Route::post('/daftar-public', [LayananController::class, 'submitPublic'])->name('layanan.public.submit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'changePassword'])->name('password.change');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::put('/gallery/{gallery}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
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
        Route::get('/export', [BermainController::class, 'export'])->name('export');
    });

    Route::prefix('bimbel')->name('bimbel.')->group(function () {
        Route::get('/', [BimbelController::class, 'index'])->name('index');
        Route::post('/store', [BimbelController::class, 'store'])->name('store');
        Route::get('/detail/{id}', [BimbelController::class, 'detail'])->name('detail');
        Route::delete('/destroy/{id}', [BimbelController::class, 'destroy'])->name('destroy');
        Route::get('/search', [BimbelController::class, 'search'])->name('search');
        Route::get('/export', [BimbelController::class, 'export'])->name('export');
    });

    Route::get('/program', [LayananController::class, 'index'])->name('layanan');
    Route::post('/program', [LayananController::class, 'submit'])->name('layanan.submit');

    Route::prefix('journal')->group(function () {
        Route::get('/', [JournalController::class, 'index'])->name('journal.index');
        Route::get('/export', [JournalController::class, 'export'])->name('journal.export');
        Route::get('/{id}', [JournalController::class, 'show'])->name('journal.show');
        Route::post('/', [JournalController::class, 'store'])->name('journal.store');
        Route::put('/{id}', [JournalController::class, 'update'])->name('journal.update');
        Route::delete('/{id}', [JournalController::class, 'destroy'])->name('journal.destroy');
    });

    Route::prefix('event')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('event.index');
        Route::get('/master', [EventController::class, 'master'])->name('event.master');
        Route::post('/master', [EventController::class, 'storeMaster'])->name('event.master.store');
        Route::delete('/master/{id}', [EventController::class, 'destroyMaster'])->name('event.master.destroy');
        Route::post('/register', [EventController::class, 'register'])->name('event.register');
        Route::get('/export', [EventController::class, 'export'])->name('event.export');
    });

    Route::prefix('daycare')->group(function () {
        Route::get('/', [DaycareController::class, 'index'])->name('daycare.index');
        Route::get('/detail/{id}', [DaycareController::class, 'detail'])->name('daycare.detail');
        Route::delete('/destroy/{id}', [DaycareController::class, 'destroy'])->name('daycare.destroy');
        Route::get('/generate-invoice/{id}', [DaycareController::class, 'generateInvoice'])->name('daycare.invoice');
        Route::get('/invoice/{id}', [DaycareController::class, 'generateInvoice'])->name('daycare.invoice');
        Route::get('/export', [DaycareController::class, 'export'])->name('daycare.export');
    });

    Route::prefix('stimulasi')->group(function () {
        Route::get('/', [StimulasiController::class, 'index'])->name('stimulasi.index');
        Route::get('/data', [StimulasiController::class, 'getData'])->name('stimulasi.data');
        Route::get('/detail/{id}', [StimulasiController::class, 'detail'])->name('stimulasi.detail');
        Route::delete('/{id}', [StimulasiController::class, 'destroy'])->name('stimulasi.destroy');
        Route::get('/generate-invoice/{id}', [StimulasiController::class, 'generateInvoice'])->name('stimulasi.invoice');
        Route::get('/export', [StimulasiController::class, 'export'])->name('stimulasi.export');
    });

    Route::prefix('article')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('article.master');
        Route::post('/', [ArticleController::class, 'store'])->name('article.store');
        Route::post('/upload-image', [ArticleController::class, 'uploadImage'])->name('article.upload.image');
        Route::get('/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');
        Route::put('/edit/{id}', [ArticleController::class, 'update'])->name('article.update');
        Route::delete('/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
        Route::get('/{id}', [ArticleController::class, 'show'])->name('article.show');
    });

    // Route untuk mengedit halaman tentang
    Route::prefix('tentang')->name('tentang.')->group(function () {
        Route::get('/edit', [AdminTentangController::class, 'edit'])->name('edit');
        Route::post('/update', [AdminTentangController::class, 'update'])->name('update');
        Route::post('/organisasi/update', [AdminTentangController::class, 'updateOrganisasi'])->name('organisasi.update');
    });

    // ***
    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('/', [FaqController::class, 'adminIndex'])->name('admin.index');
        Route::get('/create', [FaqController::class, 'create'])->name('create');
        Route::post('/', [FaqController::class, 'store'])->name('store');
        Route::get('/{faq}/edit', [FaqController::class, 'edit'])->name('edit');
        Route::put('/{faq}', [FaqController::class, 'update'])->name('update');
        Route::delete('/{faq}', [FaqController::class, 'destroy'])->name('destroy');
    });
    Route::middleware(['auth'])->group(function () {
        Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik.index');
        Route::get('/statistik/edit/{kategori}', [StatistikController::class, 'edit'])->name('statistik.edit');
        Route::put('/statistik/update/{kategori}', [StatistikController::class, 'update'])->name('statistik.update');
        Route::get('/home-content', [HomeContentController::class, 'index'])->name('home-content.index');
        Route::get('/home-content/edit', [HomeContentController::class, 'edit'])->name('home-content.edit');
        Route::put('/home-content/update', [HomeContentController::class, 'update'])->name('home-content.update');
    });

});

// Tambahkan route untuk generate invoice
Route::get('/invoice/{type}/{id}', [LayananController::class, 'generateInvoice'])->name('invoice.generate');

// Route untuk mengambil data event
Route::get('/api/events', [LayananController::class, 'getEvents']);

// Route untuk debugging
Route::get('/debug/events', function() {
    try {
        $events = \App\Models\EventModel::all();
        return response()->json([
            'success' => true,
            'count' => $events->count(),
            'events' => $events
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
    }
});

// Image upload route for TinyMCE
Route::post('/upload-image', [ImageUploadController::class, 'upload'])->name('upload.image');

Route::post('/users/article/upload-image', [App\Http\Controllers\ArticleController::class, 'uploadImage'])->name('article.upload.image');

// Frontend Article Routes
Route::get('/artikel', [App\Http\Controllers\Frontend\ArticleController::class, 'index'])->name('artikel');
Route::get('/artikel/{slug}', [App\Http\Controllers\Frontend\ArticleController::class, 'show'])->name('artikel.detail');

// Frontend Routes
Route::get('/galeri', [App\Http\Controllers\Frontend\GalleryController::class, 'index'])->name('galeri');
Route::get('/program/daycare', [App\Http\Controllers\Frontend\DaycareController::class, 'daycare'])->name('program.daycare');
Route::get('/program/stimulasi', [App\Http\Controllers\Frontend\StimulasiController::class, 'index'])->name('program.stimulasi');
Route::get('/program/bermain', [App\Http\Controllers\Frontend\BermainController::class, 'index'])->name('program.bermain');
Route::get('/program/bimbel', [App\Http\Controllers\Frontend\BimbelController::class, 'index'])->name('program.bimbel');
Route::get('/program/event', [App\Http\Controllers\Frontend\EventController::class, 'index'])->name('program.event');

// Daycare Edit Route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/daycare/edit', [App\Http\Controllers\Frontend\DaycareEditController::class, 'edit'])->name('daycare.edit');
    Route::put('/daycare/update', [App\Http\Controllers\Frontend\DaycareEditController::class, 'update'])->name('daycare.update');
});

// Stimulasi Edit Route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/stimulasi/edit', [App\Http\Controllers\Frontend\StimulasiEditController::class, 'edit'])->name('stimulasi.edit');
    Route::put('/stimulasi/update', [App\Http\Controllers\Frontend\StimulasiEditController::class, 'update'])->name('stimulasi.update');
});

// Bermain Edit Route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/bermain/edit', [App\Http\Controllers\Frontend\BermainEditController::class, 'edit'])->name('bermain.edit');
    Route::put('/bermain/update', [App\Http\Controllers\Frontend\BermainEditController::class, 'update'])->name('update.bermain');
});

// Bimbel Edit Route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/bimbel/edit', [App\Http\Controllers\Frontend\BimbelEditController::class, 'edit'])->name('bimbel.edit');
    Route::put('/bimbel/update', [App\Http\Controllers\Frontend\BimbelEditController::class, 'update'])->name('bimbel.update');
});

// Event Edit Route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/event/edit', [App\Http\Controllers\Frontend\EventEditController::class, 'index'])->name('event.edit');
    Route::put('/event/update', [App\Http\Controllers\Frontend\EventEditController::class, 'update'])->name('event.update');
});

require __DIR__.'/auth.php';

// Public FAQ Routes
Route::get('/faq', [\App\Http\Controllers\Frontend\FaqController::class, 'index'])->name('faq.public');

Route::group(['middleware' => 'useradmin'], function () {
    Route::prefix('admin/faq')->name('faq.')->group(function () {
        Route::get('/', [\App\Http\Controllers\FaqController::class, 'adminIndex'])->name('admin.index');
        Route::get('/create', [\App\Http\Controllers\FaqController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\FaqController::class, 'store'])->name('store');
        Route::get('/{faq}/edit', [\App\Http\Controllers\FaqController::class, 'edit'])->name('edit');
        Route::put('/{faq}', [\App\Http\Controllers\FaqController::class, 'update'])->name('update');
        Route::delete('/{faq}', [\App\Http\Controllers\FaqController::class, 'destroy'])->name('destroy');
    });
});

// Testimoni Routes
Route::middleware(['auth'])->group(function () {
    Route::resource('testimoni', TestimoniController::class);
});

Route::post('/faq/update-image', [FaqController::class, 'updateImage'])->name('faq.update-image');

