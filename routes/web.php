<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('mahasiswa.home');
});

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
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/kaprodi/dashboard', function () {
    return view('kaprodi.dashboard');
});

require __DIR__.'/auth.php';
