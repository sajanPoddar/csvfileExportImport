<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('allpost', 'PostController@index');
Route::get('importExport', 'CsvfileController@importExport');
Route::get('map', 'CsvfileController@map');
Route::get('downloadExcel/{type}', 'CsvfileController@downloadExcel');
Route::post('importExcel', 'CsvfileController@importExcel');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
