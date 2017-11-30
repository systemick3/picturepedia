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

Route::get('/', 'FrontController@index')->name('front');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/upload', 'UploadController@upload')->name('upload-upload');
Route::post('/upload', 'UploadController@handleUpload')->name('upload-handle-upload');
Route::get('/upload/{id}/crop', 'UploadController@crop')->name('upload-crop');
Route::post('/upload/crop', 'UploadController@handleCrop')->name('upload-crop');
Route::get('/upload/share/{id}', 'UploadController@share')->name('upload-share');
Route::post('/upload/share', 'UploadController@handleShare')->name('upload-handle-share');

Route::get('/{username}', 'UserController@index')->name('user-profile');
