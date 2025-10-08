<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('haloll', [PostController::class, 'index']);
Route::get('/buku', [PostController::class, 'buku'])->name('buku.index');
// Route::get('/limaterbaru', [PostController::class, 'limabuku'])->name('buku.index');
Route::get('/',function(){
    return view('welcome');
});

// praktikum pertemuan 7
Route::get('/buku/create',[PostController::class,'create'])->name('buku.create');
Route::post('/buku',[PostController::class,'store'])->name('buku.store');
Route::delete('/buku/{id}',[PostController::class,'destroy'])->name('buku.destroy');

Route::get('/buku/{buku}/edit', [PostController::class, 'edit'])->name('buku.edit');
Route::put('/buku/{buku}', [PostController::class, 'update'])->name('buku.update');