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
    return view('auth.login');
});

//Route::get('/', 'AccountsController.__construct');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/overview', 'HomeController@getOverview');
Route::get('/home/detail', 'HomeController@getDetail');

Route::get('/gallery', 'GalleryController@index');
Route::get('/images/index', 'GalleryController@getImage');

Route::post('/image/store', 'GalleryController@store');
Route::post('/images/upload', 'GalleryController@upload');
Route::post('/images/delete/{id}', 'GalleryController@delete');

Route::get('storage/{filename}', function ($filename)
{
//    return storage_path('app/images/' . $filename);
    return Image::make(storage_path('app/images/' . $filename))->response();
});