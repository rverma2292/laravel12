<?php

use App\Http\Controllers\LikeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $user = auth()->user();
    $likesComment = $user->likedPosts()->get();
    dd($likesComment);
    echo "Comment count: ".$user->likedComments()->count();
    echo "<br>Post count: ".$user->likedPosts()->count();
});

Route::resource('/posts', PostController::class);
Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.like');
