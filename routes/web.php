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

Route::get('/livros', 'LivrosController@index')
    ->name('listar_livros');
Route::get('/reservas', 'ReservasController@index')
    ->name('listar_reservas');
Route::get('/registro', 'RegistroController@index')
    ->name('listar_usuarios');


Route::get('/livros/criar', 'LivrosController@create')
    ->name('form_criar_livro')
    ->middleware('autenticador');
Route::get('/reservas/criar', 'ReservasController@create')
    ->name('form_criar_reserva')
    ->middleware('autenticador');

Route::post('/livros/criar', 'LivrosController@store')
    ->middleware('autenticador');
Route::post('/reservas/criar', 'ReservasController@store')
    ->middleware('autenticador');

Route::get('/livros/{id}/editar', 'LivrosController@editaLivro')
    ->name('form_editar_livro')
    ->middleware('autenticador');

Route::delete('/livros/{id}', 'LivrosController@destroy')
    ->middleware('autenticador');
Route::delete('/reservas/{id}', 'ReservasController@destroy')
    ->middleware('autenticador');
Route::delete('/registro/{id}', 'RegistroController@destroy')
    ->middleware('autenticador');   

Route::get('/entrar', 'EntrarController@index'); 
Route::post('/entrar', 'EntrarController@entrar'); 
Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');

Route::get('/sair', function () {

    Auth::logout();
    return redirect('/entrar');
});



Route::get('/home', 'HomeController@index')->name('home');

