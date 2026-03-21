<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'showRegister']);

Route::post('/register', [AuthController::class, 'register']);

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth');

Route::get('/materias', [AdminController::class, 'indexMaterias'])->name('admin.materias');

Route::post('/materias', [AdminController::class, 'saveMateria'])->name('admin.materias.save');

Route::delete('/materias/{id}', [AdminController::class, 'deleteMateria'])->name('admin.materias.delete');

Route::get('/materias/{id}/edit', [AdminController::class, 'editMateria'])->name('admin.materias.edit');

Route::put('/materias/{id}', [AdminController::class, 'updateMateria'])->name('admin.materias.update');

Route::get('/horarios', [AdminController::class, 'indexHorarios'])->name('admin.horarios');

Route::post('/horarios', [AdminController::class, 'saveHorario'])->name('admin.horarios.save');

Route::put('/horarios/{id}', [AdminController::class, 'updateHorario'])->name('admin.horarios.update');

Route::delete('/horarios/{id}', [AdminController::class, 'deleteHorario'])->name('admin.horarios.delete');

Route::get('/horarios/{id}/edit', [AdminController::class, 'editHorario'])->name('admin.horarios.edit');

Route::get('/grupos', [AdminController::class,'indexGrupos'])->name('admin.grupos');

Route::post('/grupos', [AdminController::class,'saveGrupo'])->name('admin.grupos.save');

Route::get('/grupos/{id}/edit', [AdminController::class,'editGrupo'])->name('admin.grupos.edit');

Route::put('/grupos/{id}', [AdminController::class,'updateGrupo'])->name('admin.grupos.update');

Route::delete('/grupos/{id}', [AdminController::class,'deleteGrupo'])->name('admin.grupos.delete');

Route::get('/inscripciones', [AdminController::class, 'indexInscripciones'])->name('admin.inscripciones');

Route::post('/inscripciones', [AdminController::class, 'saveInscripcion'])->name('admin.inscripciones.save');

Route::delete('/inscripciones/{id}', [AdminController::class, 'deleteInscripcion'])->name('admin.inscripciones.delete');

Route::get('/inscripciones/{id}/edit', [AdminController::class,'editInscripcion'])->name('admin.inscripciones.edit');

Route::put('/inscripciones/{id}', [AdminController::class,'updateInscripcion'])->name('admin.inscripciones.update');