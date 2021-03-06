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
Route::get('/team/{team}', [App\Http\Controllers\TeamsController::class, 'show']);
Route::get('/navi', function() {
    return view('navi');
});
Route::get('/main', function() {
    return view('main');
});



Route::get('/game', [App\Http\Controllers\HomeController::class, 'game'])->name('game');
