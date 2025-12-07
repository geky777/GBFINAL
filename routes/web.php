<?php

use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/opening-iliad', function () {
    return view('opening-iliad');
})->name('opening-iliad');

// Projects
Route::get('/iliad', function () {
    return view('iliad');
})->name('iliad');

Route::get('/opening-purple', function () {
    return view('opening-purple');
})->name('opening-purple');

Route::get('/color_purple', function () {
    return view('color_purple');
})->name('color_purple');

Route::get('/robert', function () {
    return view('robert');
})->name('robert');
