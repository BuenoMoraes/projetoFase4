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
Route::get('/series', 'SeriesController@index')
    ->name('listar_series');
Route::get('/livros', 'LivrosController@index')
    ->name('listar_livros');
Route::get('/reservas', 'ReservasController@index')
    ->name('listar_reservas');
Route::get('/usuarios', 'UsuariosController@index')
    ->name('listar_usuarios');

Route::get('/series/criar', 'SeriesController@create')
    ->name('form_criar_serie')
    ->middleware('autenticador');
Route::get('/livros/criar', 'LivrosController@create')
    ->name('form_criar_livro')
    ->middleware('autenticador');


Route::post('/series/criar', 'SeriesController@store')
    ->middleware('autenticador');
Route::post('/livros/criar', 'LivrosController@store')
    ->middleware('autenticador');


Route::delete('/series/{id}', 'SeriesController@destroy')
    ->middleware('autenticador');
Route::delete('/livros/{id}', 'LivrosController@destroy')
    ->middleware('autenticador');



Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');
Route::post('/series/{id}/editaNome', 'SeriesController@editaNome')
    ->middleware('autenticador');
Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');

Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir')
    ->middleware('autenticador');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/entrar', 'EntrarController@index'); 
Route::post('/entrar', 'EntrarController@entrar'); 
Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');

Route::get('/sair', function () {

    Auth::logout();
    return redirect('/entrar');
});