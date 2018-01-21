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

Route::get('/facebook', 'FacebookController@index')->name('facebook.index');
Route::get('/facebook/callback', 'FacebookController@callback')->name('facebook.callback');
Route::get('/twitter', 'TwitterController@index')->name('twitter.index');
Route::get('/twitter/callback', 'TwitterController@callback')->name('twitter.callback');

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/upload', 'UploadController@upload')->name('upload.upload');
Route::post('/upload', 'UploadController@handleUpload')->name('upload.handle-upload');
Route::get('/upload/{id}/crop', 'UploadController@crop')->name('upload.crop');
Route::post('/upload/crop', 'UploadController@handleCrop')->name('upload.handle-crop');
Route::get('/upload/share/{id}', 'UploadController@share')->name('upload.share');
Route::post('/upload/share', 'UploadController@handleShare')->name('upload.handle-share');
Route::get('upload/complete', 'UploadController@complete')->name('upload.complete');

Route::get('/{username}', 'UserController@index')->name('user.profile');
Route::get('/hashtag/{hashtag}', 'HashtagController@index')->name('hashtag.index');

Route::get('/like/{post_id}', 'LikeController@like')->name('like.like');
Route::get('/like/{id}/unlike', 'LikeController@unlike')->name('like.unlike');

Route::post('/comments', 'CommentController@store')->name('comment.store');

Route::middleware(['auth', 'checkuserisowner'])->group(function () {
  Route::get('/user/{id}/edit', 'UserController@edit')->name('user.edit');
  Route::post('/user/{id}/update', 'UserController@update')->name('user.update');
  Route::get('/user/{id}/avatar/edit', 'UserController@avatarEdit')->name('user.avatar.edit');
  Route::post('/user/{id}/avatar/update', 'UserController@avatarUpdate')->name('user.avatar.update');
  Route::get('/user/{id}/avatar/crop', 'UserController@avatarCrop')->name('user.avatar.crop');
  Route::post('/user/{id}/avatar/handlecrop', 'UserController@handleAvatarCrop')->name('user.avatar.handlecrop');
});
