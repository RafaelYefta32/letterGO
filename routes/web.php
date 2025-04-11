<?php

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('/my-profile', function () {
    return view('profile.profile');
})->middleware(['auth', 'verified'])->name('my-profile');

// MAHASISWA ROUTE
Route::get('/home', function () {
    return view('mahasiswa.home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/submit', [LetterController::class, 'create'])->middleware(['auth', 'verified'])->name('mahasiswa-submit');

Route::get('/history', [LetterController::class, 'index'])->middleware(['auth', 'verified'])->name('mahasiswa-history');

Route::post('/history', [LetterController::class, 'index'])->middleware(['auth', 'verified'])->name('mahasiswa-history');

Route::get('/profile', function () {
    return view('mahasiswa.profile');
})->name('mahasiswa-profile');
    
Route::post('/submit', [LetterController::class, 'store'])->middleware(['auth', 'verified'])->name('mahasiswa-store');

Route::put('/profile/{user}', [UserController::class,'update'])->middleware(['auth', 'verified'])->name('profile-user-update');

Route::get('/history/{fileSurat}', [LetterController::class, 'downloadLetter'])->middleware(['auth', 'verified'])->name('mahasiswa-download-letter');

// MO ROUTE
Route::get('/dashboard', [DashboardController::class,'indexMo'])->middleware(['auth', 'verified'])->name('mo-dashboard'); 

Route::get('/student/crud', [UserController::class, 'indexMo'])->middleware(['auth', 'verified'])->name('mo-students'); 

Route::post('/student/crud', [UserController::class,'store'])->middleware(['auth', 'verified'])->name('mo-students-store');

Route::put('/student/crud/{student}', [UserController::class,'update'])->middleware(['auth', 'verified'])->name('mo-students-update');

Route::get('/letter', [LetterController::class, 'index'])->middleware(['auth', 'verified'])->name('mo-letter');

Route::get('/course', [MataKuliahController::class,'index'])->middleware(['auth', 'verified'])->name('mo-course'); 

Route::post('/course',[MataKuliahController::class,'store'])->middleware(['auth','verified'])->name('mo-course-store');

Route::put('/course/{mataKuliah}',[MataKuliahController::class,'update'])->middleware(['auth','verified'])->name('mo-course-update');

Route::put('/letter/{pengajuan}',[LetterController::class,'uploadLetter'])->middleware(['auth','verified'])->name('mo-letter-upload');


// ADMIN ROUTE
Route::get('/admin/dashboard', [DashboardController::class, 'indexAdmin'])->middleware(['auth', 'verified'])->name('admin-dashboard');
Route::get('/user/crud', [UserController::class,'indexAdmin'])->middleware(['auth', 'verified'])->name('admin-user-crud');
Route::post('/user/crud', [UserController::class,'store'])->middleware(['auth', 'verified'])->name('admin-user-store');
Route::put('/user/crud/{user}', [UserController::class,'update'])->middleware(['auth', 'verified'])->name('admin-user-update');
Route::get('/major', [JurusanController::class,'index'])->middleware(['auth', 'verified'])->name('admin-major');
Route::post('/major', [JurusanController::class,'store'])->middleware(['auth', 'verified'])->name('admin-major-store');
Route::put('/major/{jurusan}',[JurusanController::class,'update'])->middleware(['auth','verified'])->name('admin-major-update');

// KAPRODI ROUTE
Route::get('/kaprodi/dashboard', [DashboardController::class,'indexKaprodi'])->middleware(['auth', 'verified'])->name('kaprodi-dashboard');
Route::get('/kaprodi/submissions', [LetterController::class, 'index'])->middleware(['auth', 'verified'])->name('kaprodi-submissions');
Route::put('/kaprodi/submissions/{pengajuan}/update', [LetterController::class, 'update'])->middleware(['auth', 'verified'])->name('kaprodi-submissions-update');


require __DIR__.'/auth.php';
