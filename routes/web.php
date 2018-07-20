<?php

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

Route::post('/oauth-login', 'Auth\OauthController@login')->name('oauth-login');
Route::get('/oauth/callback', 'Auth\OauthController@callback')->name('oauth-callback');

Route::get('admin', function () {
    return view('admin');
})->name('admin_panel')->middleware('admin-access');

Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard_panel')->middleware('panel-access');
