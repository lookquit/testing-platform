<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('demo', 'WebBrowserTesting@demo')->name('test');
Route::get('/', 'WebBrowserTesting@index')->name('index');

Route::post('testing', 'WebBrowserTesting@callSelenium')->name('test');

// Route::get('/', 'PageController@home');
