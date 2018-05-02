<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/
Route::view('/', 'layouts.landing');
Auth::routes();
Route::group(['prefix' => 'Plataforma', 'middleware' => 'auth'], function () {
  Route::get('/', 'HomeController@index')->name('Plataforma');

  Route::resource('/Productos', 'ProductosController', ['as' => 'Productos']);
  Route::post('/Productos/changeVisibility/{id}', 'ProductosController@changeVisibility');
  Route::post('/ProductosImagen/{imagen_id}/eliminar', 'ProductosController@deleteImage');

  Route::resource('/Categorias', 'CategoriasController', ['as' => 'Categorias']);
  Route::post('/Categorias/changeVisibility/{id}', 'CategoriasController@changeVisibility');

  Route::resource('/Subcategorias', 'SubcategoriasController', ['as' => 'Subcategorias']);
  Route::post('/Subcategorias/changeVisibility/{id}', 'SubcategoriasController@changeVisibility');

  Route::resource('/Usuarios', 'UserController', ['as' => 'Usuarios']);
});
