<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeniController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// $router->get('/teni','TeniController@index');

// $router->get('/teni/{id}','TeniController@verTeni');

// $router->post('/teni','TeniController@guardarTeni');


// $router->delete('/teni/{id}','TeniController@eliminarTeni');



// $router->post('/teni/{id}','TeniController@actualizarTeni');



Route::get('/teni', [TeniController::class, 'index'])->name('mostrarTeni');

Route::get('/teni/{id}', [TeniController::class, 'verTeni'])->name('verTeni');

Route::post('/teni', [TeniController::class, 'guardarTeni'])->name('guardarTeni');

Route::delete('/teni/{id}', [TeniController::class, 'eliminarTeni'])->name('eliminarTeni');

Route::post('/teni/{id}', [TeniController::class, 'actualizarTeni'])->name('actualizarTeni');