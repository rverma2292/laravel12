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

Route::get('/product/test-product', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment/initiate', [PaymentController::class, 'initiate'])->name('payment.initiate');
//Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
//Route::post('/payment/webhook', [PaymentController::class, 'webhook'])->name('payment.webhook');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
Route::get('/payment/refund/{paymentIntentId}', [PaymentController::class, 'refund'])->name('payment.refund');

Route::get('/eloquentqueries', [\App\Http\Controllers\QueryController::class,   'index'])->name('eloquentqueries.index');
