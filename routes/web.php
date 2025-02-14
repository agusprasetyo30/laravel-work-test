<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Master\LeaderboardController;
use App\Http\Controllers\Master\MasterQuizController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberQuestionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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
            Route::post('/assign-question', [MasterQuizController::class, 'distributeQuestions'])->name('assign-question');

            // Datatables route
            Route::prefix('/datatables')->as('datatables.')->group(function() {
                Route::get('/members', [MemberController::class, 'datatables'])->name('members');
                Route::get('/questions', [QuestionController::class, 'datatables'])->name('questions');
                Route::get('/assigned-question', [MasterQuizController::class, 'assignedQuestionDatatables'])->name('assigned-question');
            }); 

            // Member & Question Route
            Route::resource('member', MemberController::class)->only(['store', 'destroy']);
            Route::resource('question', QuestionController::class)->only(['store', 'destroy']);
        }); 

        // Leaderboard Route
        Route::prefix('/leaderboard')->as('leaderboard.')->middleware('admin_login')->group(function() {
            Route::get('/', [LeaderboardController::class, 'index'])->name('index');
            Route::get('/datatables', [LeaderboardController::class, 'datatables'])->name('datatables');
        }); 
    });

    // Member
    Route::prefix('/member')->as('member.')->group(function() {
        Route::get('/', [MemberController::class, 'index'])->name('index');
        Route::post('/login', [MemberController::class, 'memberLogin'])->name('login');

        // Member Question Route
        Route::prefix('/question')->as('question.')->middleware('member_login')->group(function() {
            Route::get('/', [MemberQuestionController::class, 'index'])->name('index');
            Route::post('/answer', [MemberQuestionController::class, 'answer'])->name('answer');
        });

    });
});

Route::get('/get-time', function () {
    return response()->json([
        'hour' => now()->format('H'),
        'minute' => now()->format('i'),
        'second' => now()->format('s'),
    ]);
});

