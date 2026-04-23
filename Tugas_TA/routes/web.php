<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Murid\DashboardController as MuridDashboardController;
use App\Http\Controllers\Murid\ClassController as MuridClassController;
use App\Http\Controllers\Murid\MaterialController as MuridMaterialController;
use App\Http\Controllers\Murid\ForumController as MuridForumController;

use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect('/admin');
        } elseif (auth()->user()->role === 'murid') {
            return redirect()->route('murid.dashboard');
        }
    }
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect('/admin');
    } elseif (auth()->user()->role === 'murid') {
        return redirect()->route('murid.dashboard');
    }
    return redirect()->route('home');
})->middleware('auth')->name('dashboard');

// Route guru telah dihapus sesuai permintaan


Route::middleware(['auth', 'role:murid'])->prefix('murid')->name('murid.')->group(function () {
    Route::get('/dashboard', [MuridDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [MuridDashboardController::class, 'profile'])->name('profile');
    
    // Kelas Routes
    Route::get('/kelas', [MuridClassController::class, 'index'])->name('kelas.index');

    // Materi Routes
    Route::get('/materi/{id}', [MuridMaterialController::class, 'show'])->name('materi.show');
    Route::get('/materi/{id}/nonton', [MuridMaterialController::class, 'video'])->name('materi.video');
    Route::get('/materi/{id}/coba', [MuridMaterialController::class, 'compiler'])->name('materi.compiler');
    Route::get('/materi/{id}/flowchart', [MuridMaterialController::class, 'flowchart'])->name('materi.flowchart');
    Route::post('/materi/run', [MuridMaterialController::class, 'run'])->name('compiler.run');


    // Forum Routes
    Route::get('/forum', [MuridForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [MuridForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [MuridForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{id}', [MuridForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{id}/reply', [MuridForumController::class, 'storeReply'])->name('forum.reply');
});

