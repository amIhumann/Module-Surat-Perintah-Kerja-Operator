<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/spkos/{id}/print_out', [\App\Http\Controllers\SpkoController::class, 'print_out'])->name('spkos.print_out');

//route resource
Route::resource('/employees', \App\Http\Controllers\EmployeeController::class);
Route::resource('/products', \App\Http\Controllers\ProductController::class);
Route::resource('/spkos', \App\Http\Controllers\SpkoController::class);
