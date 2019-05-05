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

Route::get('/',  function () {
    return view('app/home');
})->name('maps');

Route::get('/report', function () {
    return view('app/report');
})->name('report');

Route::get('/archive', function () {
    return view('app/archive');
})->name('report');

Route::get('/video', function () {
    return view('app/video');
})->name('video');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
