<?php

use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SideController;
use Illuminate\Support\Facades\Route;

Route::get('/auth/_register', [RegisterUserController::class, 'showRegistrationPage'])->name('register.show');
Route::post('/auth/_register', [RegisterUserController::class, 'processRegistration'])->name('register.process');

Route::get('/auth/_login', [LoginUserController::class, 'showLoginPage'])->name('login.show');
Route::post('/auth/_login', [LoginUserController::class, 'processLogin'])->name('login.process');

Route::get('/', [HomeController::class, 'showHomePage'])->name('home');

Route::get('/s/{sideId}', [SideController::class, 'showSidePage'])->name('side.show');
Route::get('/p/{postId}', [PostController::class, 'showPostDetailPage'])->name('post.show');
Route::get('/p/{postId}/c/{commentId}/r', [ReplyController::class, 'getReplies']);

Route::middleware(['auth'])->group(function () {
    Route::get('/s', [SideController::class, 'showCreateSidePage'])->name('create-side.show');
    Route::post('/s', [SideController::class, 'processCreateSide'])->name('create-side.process');
    Route::post('/s/{sideId}/_join', [SideController::class, 'processJoinSide'])->name('join-side.process');
    Route::get('/s/{sideId}/p', [SideController::class, 'showCreateSidePostPage']);
    Route::get('/p', [PostController::class, 'showCreatePostPage'])->name('create-post.show');
    Route::post('/p', [PostController::class, 'processCreatePost'])->name('create-post.process');
    Route::post('/p/{sideId}/_upvote', [PostController::class, 'processUpvotePost']);
    Route::post('/p/{postId}/_downvote', [PostController::class, 'processDownvotePost']);
    Route::post('/p/{postId}/_revoke-vote', [PostController::class, 'processRevokeVotePost']);
    Route::post('/p/{postId}/c', [PostController::class, 'processCreateComment']);
    Route::post('/p/{postId}/c/{commentId}', [PostController::class, 'processCreateReply']);
});
