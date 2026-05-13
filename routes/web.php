<?php

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
