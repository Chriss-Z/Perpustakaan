<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('books.index')
        : redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showlogin'])->name('login');
    Route::get('register', [AuthController::class, 'showregister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/transactions', [TransaksiController::class, 'index'])->name('transactions.index');

    Route::post(
        '/transactions/{transaction}/return',
        [TransaksiController::class, 'return']
    )->name('transactions.return');
});

Route::middleware(['checkRole:admin'])->group(function () {
    Route::resource('/books', BookController::class)->except(['index']);
    Route::resource('/users', UserController::class);
    Route::resource('/transactions', TransaksiController::class)->except(['index']);
});

Route::middleware(['checkRole:user'])->group(function () {
    Route::post(
        '/books/{book}/borrow',
        [BookController::class, 'borrow']
    )->name('transactions.borrow');
});
