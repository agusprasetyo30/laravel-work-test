<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Master\LeaderboardController;
use App\Http\Controllers\Master\MasterQuizController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Diguankan untuk dashboard awal
Route::get('/', function () {
    // check if logged in
    if (session('user_login')) {
        if (session('user_login')['role'] == 'admin') {
            return redirect()->route('admin.master.index');
        } else {
            // ini untuk member 
        }
    }

    return view('dashboard');
})->name('dashboard');

// Digunakan untuk logout
Route::post('/logout', function() {
    session()->forget('user_login');
    return redirect()->route('dashboard');
})->name('logout');

Route::prefix('/quizku')->group(function() {
    // Admin
    Route::prefix('/admin')->as('admin.')->group(function() {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::post('/login', [AdminController::class, 'adminLogin'])->name('login');

        // Master Data Route
        Route::prefix('/master-quiz')->as('master.')->middleware('admin_login')->group(function() {
            Route::get('/', [MasterQuizController::class, 'index'])->name('index');
        }); 

        // Master Data Route
        Route::prefix('/leaderboard')->as('leaderboard.')->middleware('admin_login')->group(function() {
            Route::get('/', [LeaderboardController::class, 'index'])->name('index');
        }); 
    });

    // Member
    Route::prefix('/member')->group(function() {
        
    });
});