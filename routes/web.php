<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\NoteController;

Route::GET('/', function () { return view('login'); });
Route::GET('/login', function () { return view('login'); })->name('login');
Route::GET('/signup', function () { return view('signup'); })->name('signup');

// Auth Routes
Route::prefix('api')->group(function () {
    Route::POST('/register', [AuthController::class, 'register'])->name('register');
    Route::POST('/login', [AuthController::class, 'login'])->name('login');
    Route::GET('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {

    // Dashboard Route
    Route::GET('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    // Folder Routes
    Route::GET('/folder/{id}', [FolderController::class, 'index']);
    Route::prefix('api/folder')->group(function () {
        Route::POST('/create', [FolderController::class, 'create']);
        Route::GET('/show/{id}', [FolderController::class, 'show']);
        Route::GET('/edit/{id}', [FolderController::class, 'edit']);
        Route::POST('/update/{id}', [FolderController::class, 'update']);
        Route::GET('/delete/{id}', [FolderController::class, 'destroy']);
    });

    // Notes Routes
    Route::prefix('api/note')->group(function () {
        Route::POST('/create/{id}', [NoteController::class, 'create']);
        Route::GET('/show/{id}', [NoteController::class, 'show']);
        Route::GET('/edit/{id}', [NoteController::class, 'edit']);
        Route::POST('/update/{id}', [NoteController::class, 'update']);
        Route::GET('/delete/{id}', [NoteController::class, 'destroy']);
    });
});


