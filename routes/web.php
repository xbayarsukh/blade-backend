<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ChapterImageController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/privacy', [HomeController::class, 'privacy'])->name('/privacy');

Route::get('/admin', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'checkUserRole')->group(function () {
    Route::group(['prefix'=>'admin'],function(){
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/manga-list', [MangaController::class, 'index'])->name('manga-list');
        Route::get('/manga-create', [MangaController::class, 'create'])->name('manga-create');
        Route::patch('/manga-store', [MangaController::class, 'store'])->name('manga-store');
        Route::get('/manga-edit/{id}', [MangaController::class, 'edit'])->name('manga-edit');
        Route::patch('/manga-update/{id}', [MangaController::class, 'update'])->name('manga-update');
        Route::delete('/manga-delete/{id}', [MangaController::class, 'destroy'])->name('manga-delete');

        Route::get('/category-list', [CategoryController::class, 'index'])->name('category-list');
        Route::get('/category-create', [CategoryController::class, 'create'])->name('category-create');
        Route::patch('/category-store', [CategoryController::class, 'store'])->name('category-store');
        Route::get('/category-edit/{id}', [CategoryController::class, 'edit'])->name('category-edit');
        Route::patch('/category-update/{id}', [CategoryController::class, 'update'])->name('category-update');
        Route::delete('/category-delete/{id}', [CategoryController::class, 'destroy'])->name('category-delete');

        Route::get('/manga/{manga_id}/chapter-list', [ChapterController::class, 'index'])->name('chapter-list');
        Route::get('/manga/{manga_id}/chapter-create', [ChapterController::class, 'create'])->name('chapter-create');
        Route::patch('/manga/{manga_id}/chapter-store', [ChapterController::class, 'store'])->name('chapter-store');
        Route::get('/manga/{manga_id}/chapter-edit/{id}', [ChapterController::class, 'edit'])->name('chapter-edit');
        Route::patch('/manga/{manga_id}/chapter-update/{id}', [ChapterController::class, 'update'])->name('chapter-update');
        Route::delete('/manga/{manga_id}/chapter-delete/{id}', [ChapterController::class, 'destroy'])->name('chapter-delete');

        Route::get('/manga/{manga_id}/chapter/{chapter_id}/image-list', [ChapterImageController::class, 'index'])->name('image-list');
        Route::post('/manga/{manga_id}/chapter/{chapter_id}/image-store', [ChapterImageController::class, 'store'])->name('image-store');
        Route::delete('/manga/{manga_id}/chapter/{chapter_id}/image-delete/{id}', [ChapterImageController::class, 'destroy'])->name('image-delete');
        Route::post('/manga/chapter/{id}/send-notification', [ChapterImageController::class, 'sendNotification'])->name('image-send-notification');

        Route::get('/slide-list', [SlideController::class, 'index'])->name('slide-list');
        Route::get('/slide-create', [SlideController::class, 'create'])->name('slide-create');
        Route::patch('/slide-store', [SlideController::class, 'store'])->name('slide-store');
        Route::get('/slide-edit/{id}', [SlideController::class, 'edit'])->name('slide-edit');
        Route::patch('/slide-update/{id}', [SlideController::class, 'update'])->name('slide-update');
        Route::delete('/slide-delete/{id}', [SlideController::class, 'destroy'])->name('slide-delete');

        Route::get('/membership-list', [MembershipController::class, 'index'])->name('membership-list');
        Route::get('/membership-create', [MembershipController::class, 'create'])->name('membership-create');
        Route::patch('/membership-store', [MembershipController::class, 'store'])->name('membership-store');
        Route::get('/membership-edit/{id}', [MembershipController::class, 'edit'])->name('membership-edit');
        Route::patch('/membership-update/{id}', [MembershipController::class, 'update'])->name('membership-update');
        Route::delete('/membership-delete/{id}', [MembershipController::class, 'destroy'])->name('membership-delete');

        Route::get('/order-list', [OrderController::class, 'index'])->name('order-list');
        Route::get('/order-create', [OrderController::class, 'create'])->name('order-create');
        Route::patch('/order-store', [OrderController::class, 'store'])->name('order-store');
        Route::get('/order-edit/{id}', [OrderController::class, 'edit'])->name('order-edit');
        Route::post('/order-update', [OrderController::class, 'update_status'])->name('order-update');

        Route::get('/web-settings', [SettingController::class, 'index'])->name('settings');
        Route::patch('/web-settings-update', [SettingController::class, 'update'])->name('settings-update');

        Route::get('/comment-list', [CommentController::class, 'index'])->name('comment-list');
        Route::get('/comment-edit/{id}', [CommentController::class, 'show'])->name('comment-show');
        Route::delete('/comment-delete/{id}', [CommentController::class, 'destroy'])->name('comment-delete');
    });
});

require __DIR__.'/auth.php';
