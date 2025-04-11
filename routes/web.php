<?php

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', function () {
        if (Auth::user()->id_role == 1) {
            return redirect()->route('admin-dashboard');
        } elseif (Auth::user()->id_role == 2) {
            return redirect()->route('mo-dashboard');
        } elseif (Auth::user()->id_role == 3) {
            return redirect()->route('kaprodi-dashboard');
        } elseif (Auth::user()->id_role == 4) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login');
        }
    });

    Route::get('/my-profile', function () {
        return view('profile.profile');
    })->name('my-profile');

    Route::middleware(['role:1'])->group(function () {
        // ADMIN ROUTE
        Route::get('/admin/dashboard', [DashboardController::class, 'indexAdmin'])->name('admin-dashboard');
        Route::get('/user/crud', [UserController::class, 'indexAdmin'])->name('admin-user-crud');
        Route::post('/user/crud', [UserController::class, 'store'])->name('admin-user-store');
        Route::put('/user/crud/{user}', [UserController::class, 'update'])->name('admin-user-update');
        Route::get('/major', [JurusanController::class, 'index'])->name('admin-major');
        Route::post('/major', [JurusanController::class, 'store'])->name('admin-major-store');
        Route::put('/major/{jurusan}', [JurusanController::class, 'update'])->name('admin-major-update');
    });

    Route::middleware(['role:2'])->group(function () {
        // MO ROUTE
        Route::get('/dashboard', [DashboardController::class, 'indexMo'])->name('mo-dashboard');
        Route::get('/student/crud', [UserController::class, 'indexMo'])->name('mo-students');
        Route::post('/student/crud', [UserController::class, 'store'])->name('mo-students-store');
        Route::put('/student/crud/{student}', [UserController::class, 'update'])->name('mo-students-update');
        Route::get('/letter', [LetterController::class, 'index'])->name('mo-letter');
        Route::get('/course', [MataKuliahController::class, 'index'])->name('mo-course');
        Route::post('/course', [MataKuliahController::class, 'store'])->name('mo-course-store');
        Route::put('/course/{mataKuliah}', [MataKuliahController::class, 'update'])->name('mo-course-update');
        Route::put('/letter/{pengajuan}', [LetterController::class, 'uploadLetter'])->name('mo-letter-upload');
    });

    Route::middleware(['role:3'])->group(function () {
        // KAPRODI ROUTE
        Route::get('/kaprodi/dashboard', [DashboardController::class, 'indexKaprodi'])->name('kaprodi-dashboard');
        Route::get('/kaprodi/submissions', [LetterController::class, 'index'])->name('kaprodi-submissions');
        Route::put('/kaprodi/submissions/{pengajuan}/update', [LetterController::class, 'update'])->name('kaprodi-submissions-update');
    });

    Route::middleware(['role:4'])->group(function () {
        // MAHASISWA ROUTE
        Route::get('/home', function () {
            return view('mahasiswa.home');
        })->name('home');
        Route::get('/submit', [LetterController::class, 'create'])->name('mahasiswa-submit');
        Route::get('/history', [LetterController::class, 'index'])->name('mahasiswa-history');
        Route::post('/history', [LetterController::class, 'index'])->name('mahasiswa-history');
        Route::get('/profile', function () {
            return view('mahasiswa.profile');
        })->name('mahasiswa-profile');
        Route::post('/submit', [LetterController::class, 'store'])->name('mahasiswa-store');
        Route::put('/profile/{user}', [UserController::class, 'update'])->name('profile-user-update');
        Route::get('/history/{fileSurat}', [LetterController::class, 'downloadLetter'])->name('mahasiswa-download-letter');
    });

});

require __DIR__ . '/auth.php';
