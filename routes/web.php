<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', 'PageController@index'); //sostituito a linea 37

// rotte relative all'autenticazione
// se Auth è sottolineato non preoccuparsi. Funziona ugualmente
Auth::routes();

// Auth::routes(['register'=>false]); impedisce il login
// Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')
    ->namespace('Admin') //la cartella Admin
    ->middleware('auth')
    ->name('admin.')
    ->group(function(){
        // qui vanno inserite tutte le rotte admin (il nostro CRUD)
        Route::get('/', 'HomeController@index')->name('home'); // rotta per il controller statico
        Route::resource('/posts', 'PostsController'); // rotta per il controller dinamico
    })
;

// tutte le altre rotte verranno gestite dal PageController tramite il comando:
Route::get('{any?}', 'PageController@index')->where('any','.*');
