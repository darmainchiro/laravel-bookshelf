<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\BookController;
use App\Http\Controllers\Auth\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/books', [BookController::class, 'allBook']);
Route::get('/books/{id}', [BookController::class, 'showBook']);
Route::post('/books',[BookController::class,'addBook']);
Route::patch('/books/{id}', [BookController::class, 'updateBook']);
Route::delete('/books/{id}', [BookController::class, 'deleteBook']);

//Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
