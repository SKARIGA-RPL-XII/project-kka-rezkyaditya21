<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Guru\DashboardController;
use App\Http\Controllers\Guru\ClassController;
use App\Http\Controllers\Guru\MaterialController;
use App\Http\Controllers\Guru\AssignmentController;
use App\Http\Controllers\Guru\StudentController;

use App\Http\Controllers\Murid\DashboardController as MuridDashboardController;
use App\Http\Controllers\Murid\ClassController as MuridClassController;
use App\Http\Controllers\Murid\MaterialController as MuridMaterialController;
use App\Http\Controllers\Murid\AssignmentController as MuridAssignmentController;
use App\Http\Controllers\Murid\ForumController as MuridForumController;

use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'guru') {
            return redirect()->route('guru.dashboard');
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
    if (auth()->user()->role === 'guru') {
        return redirect()->route('guru.dashboard');
    } elseif (auth()->user()->role === 'murid') {
        return redirect()->route('murid.dashboard');
    }
    return redirect()->route('home');
})->middleware('auth')->name('dashboard');

Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('kelas', ClassController::class);
    Route::resource('materi', MaterialController::class);
    Route::resource('tugas', AssignmentController::class);
    Route::resource('murid', StudentController::class);

    // Forum Routes
    Route::get('/forum', [App\Http\Controllers\Guru\ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [App\Http\Controllers\Guru\ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [App\Http\Controllers\Guru\ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{id}', [App\Http\Controllers\Guru\ForumController::class, 'show'])->name('forum.show');
    Route::put('/tugas/submission/{id}/grade', [AssignmentController::class, 'gradeSubmission'])->name('tugas.grade');
    Route::delete('/forum/{id}', [App\Http\Controllers\Guru\ForumController::class, 'destroy'])->name('forum.destroy');
    Route::post('/forum/{id}/reply', [App\Http\Controllers\Guru\ForumController::class, 'storeReply'])->name('forum.reply');
});

Route::middleware(['auth', 'role:murid'])->prefix('murid')->name('murid.')->group(function () {
    Route::get('/dashboard', [MuridDashboardController::class, 'index'])->name('dashboard');
    
    // Kelas Routes
    Route::get('/kelas', [MuridClassController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/{id}', [MuridClassController::class, 'show'])->name('kelas.show');

    // Materi Routes
    Route::get('/materi/{id}', [MuridMaterialController::class, 'show'])->name('materi.show');

    // Tugas Routes
    Route::get('/tugas/{id}', [MuridAssignmentController::class, 'show'])->name('tugas.show');
    Route::post('/tugas/{id}/submit', [MuridAssignmentController::class, 'submit'])->name('tugas.submit');

    // Forum Routes
    Route::get('/forum', [MuridForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [MuridForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [MuridForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{id}', [MuridForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{id}/reply', [MuridForumController::class, 'storeReply'])->name('forum.reply');
});
