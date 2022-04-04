<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [\App\Http\Controllers\AuthController::class, 'refresh'])->name('refresh');
    Route::post('me', [\App\Http\Controllers\AuthController::class, 'me'])->name('me');
    Route::get('/user', [\App\Http\Controllers\Api\UserController::class, 'show'])->name('show');
    Route::post('/update', [\App\Http\Controllers\Api\UserController::class, 'update'])->name('update');
    Route::get('/contratoid', [\App\Http\Controllers\Api\ContratosResponsableController::class, 'contratos'])->name('contratos');
    Route::get('/contratos/{id}/conceptos', [\App\Http\Controllers\Api\ConceptosController::class, 'show'])->name('show');
   
    Route::get('/contratos', [\App\Http\Controllers\Api\ContratosResponsableController::class, 'index'])->name('index');
    Route::get('/conceptos/{id}/avances', [\App\Http\Controllers\Api\AvancesController::class, 'show'])->name('show');
    Route::post('/avances/store', [\App\Http\Controllers\Api\AvancesController::class, 'store'])->name('store');
    Route::get('/contratos/busqueda', [\App\Http\Controllers\Api\ContratosResponsableController::class, 'busqueda'])->name('busqueda');
});