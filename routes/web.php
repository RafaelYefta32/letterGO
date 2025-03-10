<?php

use App\Http\Controllers\ProfileController;
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
Route::get('/submit', function () {
    return view('mahasiswa.submit');
});
Route::get('/history', function () {
    return view('mahasiswa.history');
});
Route::get('/profile', function () {
    return view('mahasiswa.profile');
});

Route::get('/dashboard', function () { 
    return view('mo.dashboard');
})->middleware(['auth', 'verified'])->name('mo-dashboard'); 

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin-dashboard');

Route::get('/kaprodi/dashboard', function () {
    return view('kaprodi.dashboard');
})->middleware(['auth', 'verified'])->name('kaprodi-dashboard');

require __DIR__.'/auth.php';
