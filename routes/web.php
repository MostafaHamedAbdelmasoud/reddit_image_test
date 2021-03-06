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

Route::group(['namespace' => 'Admin', 'middleware' => ['checkAdmin']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/reddit', 'RedditController@index')->name('reddit');

});
Route::get('/home', 'ModeratorController@index')->name('dashboard');
Route::get('/moderator', 'ModeratorController@index')->name('home');

