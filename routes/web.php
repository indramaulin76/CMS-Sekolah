<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Sitemap for SEO
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Posts/Berita
Route::get('/berita', [PostController::class, 'index'])->name('posts.index');
Route::get('/berita/{slug}', [PostController::class, 'show'])->name('posts.show');

// Agenda/Events
Route::get('/agenda', [EventController::class, 'index'])->name('events.index');
Route::get('/agenda/{slug}', [EventController::class, 'show'])->name('events.show');

// Categories
Route::get('/kategori/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// Static Pages
Route::get('/profil', [PageController::class, 'profil'])->name('pages.profil');
Route::get('/visi-misi', [PageController::class, 'visiMisi'])->name('pages.visi-misi');
Route::get('/organisasi', [PageController::class, 'organisasi'])->name('pages.organisasi');
Route::get('/hubungi-kami', [PageController::class, 'kontak'])->name('pages.kontak');
Route::get('/sambutan-kepala-sekolah', [PageController::class, 'sambutanKepsek'])->name('pages.sambutan');

// PPDB
use App\Http\Controllers\PpdbController;
Route::get('/ppdb', [PpdbController::class, 'index'])->name('ppdb.index');
Route::post('/ppdb/register', [PpdbController::class, 'store'])->name('ppdb.register');
Route::get('/ppdb/sukses/{code}', [PpdbController::class, 'success'])
    ->name('ppdb.success')
    ->middleware('throttle:10,1'); // Max 10 requests per minute
Route::get('/ppdb/cetak/{code}', [PpdbController::class, 'printCard'])
    ->name('ppdb.print')
    ->middleware('throttle:5,10'); // Max 5 requests per 10 minutes
Route::get('/ppdb/pengumuman', [PpdbController::class, 'announcement'])->name('ppdb.announcement');

// Gallery
use App\Http\Controllers\GalleryController;
Route::get('/galeri', [GalleryController::class, 'index'])->name('galleries.index');
Route::get('/galeri/{slug}', [GalleryController::class, 'show'])->name('galleries.show');

// Search
Route::get('/cari', [PostController::class, 'search'])->name('posts.search');

// Admin Export (protected by auth middleware in controller)
Route::get('/admin/ppdb/export-pdf/{code}', [PpdbController::class, 'exportPdf'])->name('admin.ppdb.export-pdf')->middleware('auth');
