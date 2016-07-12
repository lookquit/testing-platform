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
Route::get('page1', 'WebBrowserTesting@page1');
Route::get('page2', 'WebBrowserTesting@page2');
Route::get('page3', 'WebBrowserTesting@page3');

Route:: get('test', 'WebBrowserTesting@test');

Route::get('/{browser?}', 'WebBrowserTesting@index')->name('index');

Route::post('testing', 'WebBrowserTesting@callSelenium')->name('test');

// Route::get('/', 'PageController@home');
