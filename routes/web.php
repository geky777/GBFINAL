<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupabaseController;

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

// Supabase API Routes
Route::get('/supabase', function () {
    return view('supabase');
})->name('supabase.demo');
Route::get('/supabase/data', [SupabaseController::class, 'index'])->name('supabase.index');
Route::post('/supabase/data', [SupabaseController::class, 'store'])->name('supabase.store');
Route::put('/supabase/data/{id}', [SupabaseController::class, 'update'])->name('supabase.update');
Route::delete('/supabase/data/{id}', [SupabaseController::class, 'destroy'])->name('supabase.destroy');
