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

//CRUD --------> Después de ::class le indicamos el metodo que queremos usar
Route::get('/games', [App\Http\Controllers\GameController::class, 'getAll'])->name('game.index');
Route::get('/games/{id}', [App\Http\Controllers\GameController::class, 'getGameById']);
Route::get('/games/title/{title}', [App\Http\Controllers\GameController::class, 'getGameByTitle']);

Route::post('/games', [App\Http\Controllers\GameController::class, 'createGame']);
Route::put('/games/edit/{id}', [App\Http\Controllers\GameController::class, 'update']);
Route::delete('/games/{id}', [App\Http\Controllers\GameController::class, 'destroy']);