<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/livros', function(){
    return \App\Livro::all(); 
});*/
Route::post('login', 'Api\\AuthController@login');
$router->group(['middleware'=> ['apiJwt']], function() use($router){
    Route::post('logout', 'Api\\AuthController@logout');
    Route::apiResource('/livros', 'LivroControllerAPI');
    Route::apiResource('/reservas', 'ReservaControllerAPI');
    Route::apiResource('/registros', 'RegistroControllerAPI');
    
});

Route::post('/registros', 'RegistroControllerAPI@store');