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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/test', function () {
//     return "<h1>Halo bang</h1>";
// });

// Route::get('/test2', function () {
//     return "<h1>Ga</h1>";
// });

// Route::get('/test2', function () {
//     return view();
// });

// Route::redirect('/hengking', 'test2');

// Route::get('/griting', function () {
//     return view('greeting');
// });

Route::get('/user/{id}/{nama}', function ($id,$nama) {
    return "ID : ".$id."<br>Nama : ".$nama;
});