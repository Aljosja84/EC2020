<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/comment', [App\Http\Controllers\CommentController::class, 'index'])->name('comment');
Route::post('/comment', [App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');
Route::post('/comment/fixture/{id}', [App\Http\Controllers\CommentController::class, 'findFixture']);
Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index']);
Route::get('/notifications/mark-all-as-read', [App\Http\Controllers\NotificationController::class, 'markAllAsRead']);
Route::get('/notifications/delete-all', [App\Http\Controllers\NotificationController::class, 'deleteAll']);
Route::post('/notifications/{notificationId}/mark-as-read', [App\Http\Controllers\NotificationController::class, 'markAsRead']);
Route::post('/notifications/{notificationId}/delete', [App\Http\Controllers\NotificationController::class, 'delete']);
Route::post('/players/save-players', [App\Http\Controllers\PlayerController::class, 'store']);

Route::get('/user/following/{id}', [App\Http\Controllers\UserController::class, 'isFollowing']);
Route::get('/user/setfollow/{game}/{status}', [App\Http\Controllers\UserController::class, 'setStatus']);
Auth::routes();

Route::get('/api', function() {
    return view('api');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/games/{game}', [App\Http\Controllers\GamesController::class, 'show']);
Route::get('/ava/{user}', [App\Http\Controllers\PoolController::class, 'avatar']);
Route::get('/bettingpool/{pool}', [App\Http\Controllers\PoolController::class, 'show']);
Route::get('/bettingpool/{pool}/messages', [App\Http\Controllers\PoolController::class, 'messages']);
Route::get('/bettingpool/{pool}/{room}', [App\Http\Controllers\PoolController::class, 'room']);
Route::post('/bettingpool/{pool}/message', [App\Http\Controllers\PoolController::class, 'newMessage']);
Route::post('/bettingpool/{pool}/invitations', [App\Http\Controllers\PoolInvitationsController::class, 'store']);
Route::get('/team/{country}', [App\Http\Controllers\CountryController::class, 'show']);
Route::get('/test', [App\Http\Controllers\HomeController::class, 'test'])->name('test');
Route::get('/navi', function() {
    return view('navi');
});
Route::get('/main', [App\Http\Controllers\HomeController::class, 'index'])->name('main');
Route::get('/welcome', function() {
    return view('welcome');
});



Route::get('/game', [App\Http\Controllers\HomeController::class, 'game'])->name('game');
