<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomePage;
use App\Http\Controllers\Backend\Dashboard;
use App\Http\Controllers\Backend\Authh;
use App\Http\Controllers\Backend\ArticlesController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PageController;

Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function () {
    Route::get('login', [Authh::class, 'login'])->name('login');
    Route::post('login', [Authh::class, 'loginPost'])->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
    Route::get('panel', [Dashboard::class, 'index'])->name('dashboard');
    //Makale Route
    Route::get('makaleler/copkutusu', [ArticlesController::class, 'copkutusu'])->name('copkutusu');
    Route::resource('makaleler', ArticlesController::class);
    Route::get('admin/checkbox', [ArticlesController::class, 'checkbox'])->name('checkbox');
    Route::get('/delete/{id}', [ArticlesController::class, 'delete'])->name('delete');
    Route::get('kaldır/{id}',[ArticlesController::class, 'kaldır'])->name('kaldır');
    Route::get('geriyukle/{id}', [ArticlesController::class, 'geriyukle'])->name('geriyukle');
    //Kategori Route
    Route::get('kategoriler', [CategoryController::class, 'index'])->name('kategoriler');
    Route::post('kategoriler/create', [CategoryController::class, 'create'])->name('kategori.create');
    Route::post('kategoriler/update', [CategoryController::class, 'update'])->name('kategori.update');
    Route::get('kategoriler/edit', [CategoryController::class, 'edit'])->name('kategori.edit');
    Route::delete('kategoriler/sil/{id}', [CategoryController::class, 'silme'])->name('kategori.silme');

    //Pages Route
    Route::get('sayfalar',[PageController::class, 'index'])->name('sayfalar');
    Route::get('sayfalar/edit/{id}', [PageController::class, 'edit'])->name('sayfalar.edit');
    Route::put('admin/sayfalar/update/{id}', [PageController::class, 'update'])->name('sayfalar.update');
    Route::get('logout', [Authh::class, 'logout'])->name('logout');
});




// FrontEnd Routes
Route::get('/', [HomePage::class, 'index'])->name('home');
Route::get('/kategori/{category}', [HomePage::class, 'category'])->name('category');
Route::get('iletisim', [HomePage::class, 'contact'])->name('contact');
Route::post('iletisim', [HomePage::class, 'contactPost'])->name('contactPost');
Route::get('/{category}/{slug}', [HomePage::class, 'single'])->name('single');
Route::get('/{sayfa}', [HomePage::class, 'page'])->name('page');
