<?php

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
})->middleware(['auth', 'verified']);


Route::get('/home', function () {
    return view('mahasiswa.home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// Mahasiswa route
Route::get('/submit', function () {
    return view('mahasiswa.submit');
});
Route::get('/history', function () {
    return view('mahasiswa.history');
});
Route::get('/profile', function () {
    return view('mahasiswa.profile');
});

// MO route
Route::get('/dashboard', function () { 
    return view('mo.dashboard');
})->middleware(['auth', 'verified'])->name('mo-dashboard'); 

Route::get('/student/crud', [UserController::class, 'indexMo'])->middleware(['auth', 'verified'])->name('mo-students'); 

Route::post('/student/crud', [UserController::class,'store'])->middleware(['auth', 'verified'])->name('mo-students-store');

Route::get('/letter', function () { 
    return view('mo.letter');
})->middleware(['auth', 'verified'])->name('mo-letter'); 

Route::get('/course', [MataKuliahController::class,'index'])->middleware(['auth', 'verified'])->name('mo-course'); 

Route::post('/course',[MataKuliahController::class,'store'])->middleware(['auth','verified'])->name('mo-course-store');

// admin route
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin-dashboard');

Route::get('/user/crud', [UserController::class,'indexAdmin'])->middleware(['auth', 'verified'])->name('admin-user-crud');

Route::post('/user/crud', [UserController::class,'store'])->middleware(['auth', 'verified'])->name('admin-user-store');

Route::get('/major', [JurusanController::class,'index'])->middleware(['auth', 'verified'])->name('admin-major');

Route::post('/major', [JurusanController::class,'store'])->middleware(['auth', 'verified'])->name('admin-major-store');

// kaprodi route
Route::get('/kaprodi/dashboard', function () {
    return view('kaprodi.dashboard');
})->middleware(['auth', 'verified'])->name('kaprodi-dashboard');

Route::get('/kaprodi/pengajuan', function () {
    return view('kaprodi.pengajuan');
})->middleware(['auth', 'verified'])->name('kaprodi-pengajuan');

require __DIR__.'/auth.php';
