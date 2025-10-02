<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('haloll', [PostController::class, 'index']);
Route::get('/buku', [PostController::class, 'buku'])->name('buku.index');
Route::get('/limaterbaru', [PostController::class, 'limabuku'])->name('buku.index');
Route::get('/',function(){
    return view('welcome');
});