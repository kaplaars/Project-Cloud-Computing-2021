<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\F1controller;
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

Route::get('/homepage', [F1controller::class, 'homepage']);
Route::get('/highlights', [F1controller::class, 'highlights']);
Route::get('/championschip', [F1controller::class, 'championschip']);
Route::get('/calender', [F1controller::class, 'calender']);
