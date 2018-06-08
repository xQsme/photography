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

Route::get('/', 'Controller@home')->name('home');
Route::get('/galeria/{id}', 'Controller@galeria')->name('galeria');
Route::get('/galeria', 'Controller@galeriaDefault')->name('default');
Route::get('/sobre', 'Controller@sobre')->name('sobre');
Route::get('/workshop', 'Controller@workshop')->name('workshop');
Route::get('/xd457ps', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/xd457ps', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/add/{galeria}', 'Controller@add')->name('add');
Route::post('/add/{galeria}', 'Controller@store');
Route::get('/addGaleria', 'Controller@addGaleria')->name('addGaleria');
Route::post('/addGaleria', 'Controller@storeGaleria');
Route::get('/addLista', 'Controller@addLista')->name('addLista');
Route::post('/addLista', 'Controller@storeLista');
Route::get('/edit/{galeria}', 'Controller@edit')->name('edit');
Route::post('/edit/{galeria}', 'Controller@storeEdit');
Route::get('/delete/{foto}', 'Controller@delete')->name('delete');
Route::get('/deleteLista/{lista}', 'Controller@deleteLista')->name('deleteLista');
Route::get('/deleteGaleria/{galeria}', 'Controller@deleteGaleria')->name('deleteGaleria');
Route::get('/move/{galeria}', 'Controller@move')->name('move');
Route::get('/editHome', 'Controller@editHome')->name('editHome');
Route::post('/editHome', 'Controller@storeHome');
Route::get('/deleteHome', 'Controller@deleteHome')->name('deleteHome');
Route::get('/deleteHome/{home}', 'Controller@destroyHome')->name('destroyHome');