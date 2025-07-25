<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResearchRequestController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/researchrequest',[ResearchRequestController::class,'index'])->name('researchrequest.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/researchrequest/user/{userId}', [ResearchRequestController::class, 'researchByUser'])->name('researchrequest.user');
});

Route::get('/researchrequest/create', [ResearchRequestController::class, 'create'])->name('researchrequest.create');
Route::get('/researchrequest/{id}/edit', [ResearchRequestController::class, 'edit'])->name('researchrequest.edit');
Route::get('/researchrequest/{id}', [ResearchRequestController::class, 'show'])->name('researchrequest.show');
Route::post('/researchrequest', [ResearchRequestController::class, 'store'])->name('researchrequest.store');
Route::put('/researchrequest/{id}', [ResearchRequestController::class, 'update'])->name('researchrequest.update');
Route::delete('/researchrequest/{id}', [ResearchRequestController::class, 'destroy'])->name('researchrequest.destroy');



// Ini akan menghasilkan semua 7 route di atas otomatis, sesuai konvensi Laravel.
// Route::resource('researchrequest', ResearchRequestController::class);

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');