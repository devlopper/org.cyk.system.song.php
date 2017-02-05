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
Route::get('song/update/{id}', 'song\SongController@showUpdatePage')->name('showSongUpdatePage');
/* Service */
Route::get('song/get/many', 'song\SongController@getSongs')->name('getSongs');

Route::get('/', function () {
    return view('welcome');
});

Route::get('bootstrap', function () {
    return view('bootstrap');
});

Route::get('template/up_right_bottom_left', 'playground\TemplateController@upRightBottomLeft');
Route::get('playground/editor/jquery', 'playground\EditorController@jquery');

Route::get('song', 'song\SongController@showListPage');

Route::get('song', [
  'as' => 'song',
  'uses' => 'song\SongController@showListPage'
]);

Route::post('saveSong', 'song\SongController@save');
