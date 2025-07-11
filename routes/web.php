<?php

use App\Http\Controllers\ResearchRequestController;
use Illuminate\Support\Facades\Route;


Route::get('/researchrequest',[ResearchRequestController::class,'index'])->name('researchrequest.index');
Route::get('/researchrequest/create', [ResearchRequestController::class, 'create'])->name('researchrequest.create');
Route::get('/researchrequest/{id}/edit', [ResearchRequestController::class, 'edit'])->name('researchrequest.edit');
Route::get('/researchrequest/{id}', [ResearchRequestController::class, 'show'])->name('researchrequest.show');
Route::post('/researchrequest', [ResearchRequestController::class, 'store'])->name('researchrequest.store');
Route::patch('/researchrequest/{id}', [ResearchRequestController::class, 'update'])->name('researchrequest.update');
Route::delete('/researchrequest/{id}', [ResearchRequestController::class, 'destroy'])->name('researchrequest.destroy');



