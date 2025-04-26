<?php

use App\Http\Controllers\MediaController;
use App\Http\Controllers\MyFileController;
use Illuminate\Support\Facades\Route;


Route::get('/',[MyFileController::class, 'index'])->name('index');
Route::get('/add',[MyFileController::class, 'add'])->name('file.add');
Route::post('/store',[MyFileController::class, 'store'])->name('file.store');
Route::get('/view/{id}',[MyFileController::class, 'show'])->name('file.show');
Route::get('/edit/{id}',[MyFileController::class, 'edit'])->name('file.edit');
Route::put('/update/{id}',[MyFileController::class, 'update'])->name('file.update');
Route::delete('/destroy/{id}',[MyFileController::class, 'destroy'])->name('file.destroy');
