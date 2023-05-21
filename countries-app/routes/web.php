<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/search', function () {
    return view('search');
})->name('search');

//The route for the search nav button
Route::get('/', function () {
    return view('search');
})->name('search');

//The route for the economics nav button
Route::get('/economics', function () {
    return view('economics');
})->name('economics');

//The route for the safety nav button
Route::get('/safety', function () {
    return view('safety');
});
