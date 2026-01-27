<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Guru\DashboardController;
use App\Http\Controllers\Guru\ClassController;
use App\Http\Controllers\Guru\MaterialController;
use App\Http\Controllers\Guru\AssignmentController;
use App\Http\Controllers\Guru\StudentController;

use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    if (auth()->check() && auth()->user()->role === 'guru') {
        return redirect()->route('guru.dashboard');
    }
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'guru') {
        return redirect()->route('guru.dashboard');
    }
    return redirect()->route('home');
})->middleware('auth')->name('dashboard');

Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('kelas', ClassController::class);
    Route::resource('materi', MaterialController::class);
    Route::resource('tugas', AssignmentController::class);
    Route::resource('murid', StudentController::class);
});
