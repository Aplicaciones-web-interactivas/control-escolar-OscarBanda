<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/materias', [AdminController::class, 'indexMaterias'])->name('admin.materias');

Route::post('/materias', [AdminController::class, 'saveMateria'])->name('admin.materias.save');

Route::delete('/materias/{id}', [AdminController::class, 'deleteMateria'])->name('admin.materias.delete');

Route::get('/materias/{id}/edit', [AdminController::class, 'editMateria'])->name('admin.materias.edit');

Route::put('/materias/{id}', [AdminController::class, 'updateMateria'])->name('admin.materias.update');