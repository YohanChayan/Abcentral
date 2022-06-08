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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');


Route::get('/', function(){
    return view('home');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');



Route::post('/searchBook', array(
    'as' => 'searchBook',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\LibroController@search'
));

Route::post('/searchBook', array(
    'as' => 'searchBook',
    'uses' => 'App\Http\Controllers\LibroController@search'
));

Route::get('/deletebook/{id}', array(
    'as' => 'deletebook',
    'uses' => 'App\Http\Controllers\LibroController@deleteBook'
));

Route::get('/logs', array(
    'as' => 'logs',
    'uses' => 'App\Http\Controllers\LogController@index'
));


Route::resource('libros', 'App\Http\Controllers\LibroController');


 // Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
 //     return view('dashboard');
 // })->name('dashboard');
