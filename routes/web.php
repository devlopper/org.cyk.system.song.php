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

Route::get('/', function () {
    return view('welcome');
});

Route::get('bootstrap', function () {
    return view('bootstrap');
});

Route::get('template/up_right_bottom_left', 'playground\TemplateController@upRightBottomLeft');
Route::get('playground/editor/jquery', 'playground\EditorController@jquery');

//Route::get('song', 'song\SongController@showListPage');

/*Route::get('song', [
  'as' => 'song',
  'uses' => 'song\SongController@showListPage'
]);*/

//Route::post('saveSong', '\App\Http\Controllers\Song\SongController@save');
