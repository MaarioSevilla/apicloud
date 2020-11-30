<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::group([
    'middleware' => 'api',

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

//00 user queries
Route::get('/myuser/{matriculaID}', 'App\Http\Controllers\UsController@myUser');
Route::resource('/user', 'App\Http\Controllers\UsController')->except([
    'create', 'edit'
]);

//01 circle aparentemente done pero no done
Route::get('/circulo/cebyid/{matriculaID}', 'App\Http\Controllers\CirculoEstudiantilController@cebyid');
Route::resource('/circulo', 'App\Http\Controllers\CirculoEstudiantilController')->except([
    'create', 'edit'
]);

//02 resultado covide work
Route::get('/resultcovide/showme/{matriculai}', 'App\Http\Controllers\ResultadoCovidEController@showMe');
Route::resource('/resultcovide', 'App\Http\Controllers\ResultadoCovidEController')->except([
    'create', 'edit'
]);

//03 temperatura work
Route::get('/temperatura/showallbymat/{idMatricula}', 'App\Http\Controllers\TemperaturaCEController@showtempbyid');
Route::get('/temperatura/showthreebymat/{idMatricula}', 'App\Http\Controllers\TemperaturaCEController@showtempthreebyid');
Route::resource('/temperatura', 'App\Http\Controllers\TemperaturaCEController')->except([
    'create', 'edit'
]);

//04 sgto tos work
Route::get('/sgtotos/showallbymat/{iSTMatricula}', 'App\Http\Controllers\SgtoTosController@showtosbyid');
Route::get('/sgtotos/onelastreg/{iSTMatricula}', 'App\Http\Controllers\SgtoTosController@showlastmat');
Route::get('/sgtotos/showthreebymat/{iSTMatricula}', 'App\Http\Controllers\SgtoTosController@showthreebymat');
Route::resource('/sgtotos', 'App\Http\Controllers\SgtoTosController')->except([
    'create', 'edit'
]);

//05 sgto aire
Route::get('/sgtoaire/showallbymat/{iSAMatricula}', 'App\Http\Controllers\SgtoAireController@showallbymat');
Route::get('/sgtoaire/onelastreg/{iSAMatricula}', 'App\Http\Controllers\SgtoAireController@onelastreg');
Route::get('/sgtoaire/showthreebymat/{idMatricula}', 'App\Http\Controllers\SgtoAireController@showthreebymat');
Route::resource('/sgtoaire', 'App\Http\Controllers\SgtoAireController')->except([
    'create', 'edit'
]);

//06 sgto symptoms
Route::get('/sgtosymptoms/onelastreg/{iMatricula}', 'App\Http\Controllers\SgtoSintomasController@onelastreg');
Route::get('/sgtosymptoms/showallbymat/{iMatricula}/{sintoma}', 'App\Http\Controllers\SgtoSintomasController@showallbymat');
Route::get('/sgtosymptoms/showthreebymat/{iMatricula}/{sintoma}', 'App\Http\Controllers\SgtoSintomasController@showthreebymat');
Route::resource('/sgtosymptoms', 'App\Http\Controllers\SgtoSintomasController')->except([
    'create', 'edit'
]);

//07 family listo
Route::get('/family/myfamily/{idFMatricula}', 'App\Http\Controllers\FamiliaresController@myfamily');
Route::resource('/family', 'App\Http\Controllers\FamiliaresController')->except([
    'create', 'edit'
]);

//08 sgto symptoms family pendiente
Route::get('/sgtofamily/myfamily/{matricula}', 'App\Http\Controllers\SeguimientoFamiliarController@showSgtoFamily');
Route::get('/sgtofamily/showthree/{matricula}', 'App\Http\Controllers\SeguimientoFamiliarController@showthree');
Route::resource('/sgtofamily', 'App\Http\Controllers\SeguimientoFamiliarController')->except([
    'create', 'edit'
]);

//09 result covid family pendiente
Route::resource('/resultcovidf', 'App\Http\Controllers\ResultadoCovidFController')->except([
    'create', 'edit'
]);

//10 pruebas compartidas
Route::get('/pruebaq', 'App\Http\Controllers\SharedQueriesController@PruebaQueryBuilder');
Route::get('/pruebaelo', 'App\Http\Controllers\SharedQueriesController@PruebaEloquent');
