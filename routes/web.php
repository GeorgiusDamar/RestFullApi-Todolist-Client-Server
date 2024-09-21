<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TodolistController;

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



Route::get('/', [LoginController::class, 'index'])->name('login');


Route::post('/login', [LoginController::class, 'loginProses'])->name('login-proses');


// gunakan prefix
Route::group(['prefix' => 'user', 'middleware' => ['auth'], 'as' => 'user.'], function () {
    // Route::redirect('/home', '/user');
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::get('/todolist', [TodolistController::class, 'todolist'])->name('todolist');
    Route::post('/todolist', [TodolistController::class, 'store'])->name('store');
    Route::delete('/tasks/{task}', [TodolistController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('/tasks/{task}/complete', [TodolistController::class, 'complete'])->name('tasks.complete');
});



// logout 
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
