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
})->name('root');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/posts', 'PostController')->middleware('auth');

Route::get('/github/login', 'GithubController@redirect')->name('github.login');
Route::get('/github/login/callback', 'GithubController@handleCallback')->name('github.login.callback');
Route::get('/github/info', 'GithubController@info')->name('github.info');
Route::get('/google/login', 'GoogleController@redirect')->name('google.login');
Route::get('/google/login/callback', 'GoogleController@handleCallback')->name('google.login.callback');
Route::get('/google/info', 'GoogleController@info')->name('google.info');

Auth::routes();