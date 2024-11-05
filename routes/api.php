<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MangaController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ChapterController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CommentController;

Route::group(['prefix'=>'v1'],function(){
    Route::group(['prefix'=>'auth'],function(){
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/send-otp', [AuthController::class, 'sendOtp']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    });
    Route::get('/slide-manga-list', [MangaController::class, 'slide']);
    Route::get('/new-manga-list', [MangaController::class, 'new']);
    Route::get('/ongoing-manga-list', [MangaController::class, 'ongoing']);
    Route::get('/finish-manga-list', [MangaController::class, 'finish']);
    Route::get('/premium-manga-list', [MangaController::class, 'premium']);
    Route::get('/manga/{id}', [MangaController::class, 'manga']);
    Route::get('/categories-list', [CategoryController::class, 'categories']);
    Route::get('/category-manga-list/{id}', [CategoryController::class, 'category_manga']);
    Route::middleware('auth:sanctum')->group( function () {
        Route::post('/auth/check', [AuthController::class, 'check']);
        Route::get('/about', [AboutController::class, 'index']);
        Route::get('/chapter/{id}', [MangaController::class, 'chapter']);
        Route::get('/comments/{id}', [ChapterController::class, 'forgot-password']);
        Route::get('/download-chapter/{id}', [ChapterController::class, 'forgot-password']);
        Route::get('/memberships-list', [OtherController::class, 'index']);
        Route::get('/favourite-list', [MangaController::class, 'favManga']);
        Route::post('/favourite-update/{id}', [MangaController::class, 'favourite']);
        Route::get('/membership-list', [OrderController::class, 'memberships']);
        Route::get('/notification-list', [AboutController::class, 'notifications']);
        Route::get('/comment-list/{id}', [CommentController::class, 'index']);
        Route::post('/comment-create/{id}', [CommentController::class, 'create']);
        Route::post('/comment-delete/{id}', [CommentController::class, 'delete']);
    });
});

Route::fallback(function() {
    return response()->json([
        'data' => [],
        'success' => false,
        'status' => 404,
        'message' => 'Invalid Route'
    ]);
});