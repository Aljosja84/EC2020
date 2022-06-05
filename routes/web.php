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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/api', function() {
    return view('api');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/games/{game}', [App\Http\Controllers\GamesController::class, 'show']);
Route::get('/ava/{user}', [App\Http\Controllers\PoolController::class, 'avatar']);
Route::get('/bettingpool/{pool}', [App\Http\Controllers\PoolController::class, 'show'])->middleware('pool');
Route::get('/bettingpool/{pool}/messages', [App\Http\Controllers\PoolController::class, 'messages']);
Route::get('/bettingpool/{pool}/{room}', [App\Http\Controllers\PoolController::class, 'room']);
Route::post('/bettingpool/{pool}/message', [App\Http\Controllers\PoolController::class, 'newMessage']);
Route::get('/team/{country}', [App\Http\Controllers\CountryController::class, 'show']);
Route::get('/test', [App\Http\Controllers\HomeController::class, 'test'])->name('test');
Route::get('/navi', function() {
    return view('navi');
});
Route::get('/main', function() {
    return view('main');
});
Route::get('/welcome', function() {
    return view('welcome');
});


Route::get('/game', [App\Http\Controllers\HomeController::class, 'game'])->name('game');
