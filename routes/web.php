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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::delete('/eliminar-producto/{id}', 'HomeController@destroyProduct')->name('destroyProduct');

Route::POST('/editar-producto/{id}', 'HomeController@editProduct')->name('editProduct');

Route::POST('/actualizar-producto/{id}', 'HomeController@updateProduct')->name('updateProduct');

Route::POST('/ver-producto/{id}', 'HomeController@viewProduct')->name('viewProduct');

Route::POST('/almacenar-producto', 'HomeController@storageProduct')->name('storageProduct');

Route::get('/test', 'HomeController@test')->name('test');
