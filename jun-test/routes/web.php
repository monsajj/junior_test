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
    return view('welcome');
})->name('home');

Route::get('files', 'Files\FileController@index')->name('files.show');
Route::post('files', 'Files\FileController@store')->name('files.store');

Route::get('books/{from}/list', 'OOP\BookController@index')->name('books.list');
Route::get('books/{from}/{id}', 'OOP\BookController@show')->name('books.show');
Route::post('books/{from}/store', 'OOP\BookController@store')->name('books.store');
Route::put('books/admin/{id}/changeStatus', 'OOP\BookController@changeStatus')->name('books.change.status');

Route::get('luhn', 'Luhn\LuhnController@index')->name('luhn.show');
Route::post('luhn/check', 'Luhn\LuhnController@check')->name('luhn.check');
