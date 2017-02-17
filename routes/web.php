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
/* ------------- Song -------------*/
/* Page */
Route::get('song/list', 'song\SongController@showListPage')->name('showSongListPage');
Route::get('song/create', 'song\SongController@showCreatePage')->name('showSongCreatePage');
Route::get('song/read/{id}', 'song\SongController@showReadPage')->name('showSongReadPage');
Route::get('song/update/{id}', 'song\SongController@showUpdatePage')->name('showSongUpdatePage');
Route::get('song/delete/{id}', 'song\SongController@showDeletePage')->name('showSongDeletePage');
/* Service */
Route::get('song/get/many', 'song\SongController@getMany')->name('getSongMany');
Route::post('song/crud/one', '\App\Http\Controllers\Song\SongController@crudOne')->name('crudSongOne');

/* ------------- File -------------*/
/* Page */
Route::get('file/list', 'file\FileController@showListPage')->name('showFileListPage');
Route::get('file/create', 'file\FileController@showCreatePage')->name('showFileCreatePage');
Route::get('file/read/{id}', 'file\FileController@showReadPage')->name('showFileReadPage');
Route::get('file/update/{id}', 'file\FileController@showUpdatePage')->name('showFileUpdatePage');
Route::get('file/delete/{id}', 'file\FileController@showDeletePage')->name('showFileDeletePage');
/* Service */
Route::get('file/get/many', 'file\FileController@getMany')->name('getFileMany');
Route::post('file/crud/one', '\App\Http\Controllers\File\FileController@crudOne')->name('crudFileOne');
Route::get('file/get/one/bytes/{id}', 'file\FileController@getOneBytes')->name('getFileOneBytes');

/* ------------- Joined File -------------*/
/* Page */
Route::get('joinedfile/list', 'file\JoinedFileController@showListPage')->name('showJoinedFileListPage');
Route::get('joinedfile/create', 'file\JoinedFileController@showCreatePage')->name('showJoinedFileCreatePage');
Route::get('joinedfile/read/{id}', 'file\JoinedFileController@showReadPage')->name('showJoinedFileReadPage');
Route::get('joinedfile/update/{id}', 'file\JoinedFileController@showUpdatePage')->name('showJoinedFileUpdatePage');
Route::get('joinedfile/delete/{id}', 'file\JoinedFileController@showDeletePage')->name('showJoinedFileDeletePage');
/* Service */
Route::get('joinedfile/get/many', 'file\JoinedFileController@getMany')->name('getJoinedFileMany');
Route::post('joinedfile/crud/one', '\App\Http\Controllers\File\JoinedFileController@crudOne')->name('crudJoinedFileOne');

/* ------------- Tag -------------*/
/* Page */
Route::get('tag/list', 'tag\TagController@showListPage')->name('showTagListPage');
Route::get('tag/create', 'tag\TagController@showCreatePage')->name('showTagCreatePage');
Route::get('tag/read/{id}', 'tag\TagController@showReadPage')->name('showTagReadPage');
Route::get('tag/update/{id}', 'tag\TagController@showUpdatePage')->name('showTagUpdatePage');
Route::get('tag/delete/{id}', 'tag\TagController@showDeletePage')->name('showTagDeletePage');
/* Service */
Route::get('tag/get/many', 'tag\TagController@getMany')->name('getTagMany');
Route::post('tag/crud/one', '\App\Http\Controllers\Tag\TagController@crudOne')->name('crudTagOne');

Route::get('/', function () {
    return view('welcome');
});

Route::get('bootstrap', function () {
    return view('bootstrap');
});

Route::get('template/up_right_bottom_left', 'playground\TemplateController@upRightBottomLeft');
Route::get('playground/editor/jquery', 'playground\EditorController@jquery');
