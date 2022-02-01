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

/*Rotas Telas Apresentações */
Route::get('/livros', 'LivrosController@index')
    ->name('listar_livros');

Route::get('/reservas', 'ReservasController@index')
    ->name('listar_reservas');

Route::get('/registro', 'RegistroController@index')
    ->name('listar_usuarios');


/*Rotas Telas criação dados*/
Route::get('/livros/criar', 'LivrosController@create')
    ->name('form_criar_livro')
    ->middleware('autenticador');
Route::get('/reservas/criar', 'ReservasController@create')
    ->name('form_criar_reserva')
    ->middleware('autenticador');

/*Rotas Adicionar valores ao banco*/
Route::post('/livros/criar', 'LivrosController@store')
    ->middleware('autenticador');
Route::post('/reservas/criar', 'ReservasController@store')
    ->middleware('autenticador');

/*Rotas e envio das atualizações*/ 
Route::get('/registro/edit/{id}', 'RegistroController@edit')
    ->middleware('autenticador');
Route::post('/registro/edit/{id}', 'RegistroController@editaUsuario')
    ->middleware('autenticador');

Route::get('/livros/edit/{id}', 'LivrosController@edit')
    ->middleware('autenticador');
Route::post('/livros/edit/{id}', 'LivrosController@editaLivro')
    ->middleware('autenticador');

Route::get('/reservas/edit/{id}', 'ReservasController@edit')
    ->middleware('autenticador');
Route::post('/reservas/edit/{id}', 'ReservasController@editaReserva')
    ->middleware('autenticador');


/*Rotas deletar dados banco*/
Route::delete('/livros/{id}', 'LivrosController@destroy')
    ->middleware('autenticador');
Route::delete('/reservas/{id}', 'ReservasController@destroy')
    ->middleware('autenticador');
Route::delete('/registro/{id}', 'RegistroController@destroy')
    ->middleware('autenticador');   

/*Rotas Autenticação de Usuário e criaçãos */
Route::get('/entrar', 'EntrarController@index'); 
Route::post('/entrar', 'EntrarController@entrar'); 
Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');

Route::get('/sair', function () {

    Auth::logout();
    return redirect('/entrar');
});


