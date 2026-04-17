<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\GalleryController;

// ─── Landing Page ─────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita/{id}', [HomeController::class, 'showArticle'])->name('article.show');

// ─── Admin Auth ───────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',  [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/',         [DashboardController::class, 'index'])->name('dashboard');

        // Settings
        Route::get('/settings/hero',                [SettingController::class, 'hero'])->name('settings.hero');
        Route::post('/settings/hero',               [SettingController::class, 'heroUpdate'])->name('settings.hero.update');
        Route::get('/settings/visi-misi',           [SettingController::class, 'visiMisi'])->name('settings.visi-misi');
        Route::post('/settings/visi-misi',          [SettingController::class, 'visiMisiUpdate'])->name('settings.visi-misi.update');
        Route::get('/settings/sambutan',            [SettingController::class, 'sambutan'])->name('settings.sambutan');
        Route::post('/settings/sambutan',           [SettingController::class, 'sambutanUpdate'])->name('settings.sambutan.update');
        Route::get('/settings/pengurus-photo',      [SettingController::class, 'pengurusPhoto'])->name('settings.pengurus-photo');
        Route::post('/settings/pengurus-photo',     [SettingController::class, 'pengurusPhotoUpdate'])->name('settings.pengurus-photo.update');
        Route::get('/settings/general',             [SettingController::class, 'general'])->name('settings.general');
        Route::post('/settings/general',            [SettingController::class, 'generalUpdate'])->name('settings.general.update');

        // Members
        Route::resource('members',    MemberController::class);
        // Commissions
        Route::resource('commissions', CommissionController::class);
        // Galleries (Hero Slider)
        Route::resource('galleries', GalleryController::class);
        // Articles (Berita & Angket)
        Route::resource('articles',   \App\Http\Controllers\Admin\ArticleController::class);
    });
});
