<?php

use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EstudiosController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyectosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');
Route::get('/dashboard', [PanelController::class, 'index'])->middleware(['auth', 'verified'])->name('panel.index');
Route::get('/docentes', [DocenteController::class, 'index'])->middleware(['auth', 'verified'])->name('docentes.index');
Route::get('/novedades', [ProyectosController::class, 'index'])->middleware(['auth', 'verified'])->name('novedades.index');
Route::get('/novedades/{novedad}', [ProyectosController::class, 'show'])->middleware(['auth', 'verified'])->name('novedades.show');
Route::delete('/novedades/{novedad}/destroy', [ProyectosController::class, 'destroy'])->middleware(['auth', 'verified'])->name('novedades.destroy');
Route::delete('/docentes/{docente}/destroy', [DocenteController::class, 'destroy'])->middleware(['auth', 'verified'])->name('docentes.destroy');
Route::get('/exportar/{semestre?}', [ExcelController::class, 'exportarExcelNovedad'])->middleware(['auth', 'verified'])->name('novedades.exportnovedades');
Route::get('/docentes/create', [DocenteController::class, 'create'])->middleware(['auth', 'verified'])->name('docentes.create');
Route::get('/proyectosespeciales/{docente}', [ProyectosController::class, 'create'])->middleware(['auth', 'verified'])->name('proyectos.create');
Route::get('/docentes/{docente}/estudios/create', [DocenteController::class, 'createStudies'])->middleware(['auth', 'verified'])->name('docentes.estudios.create');
Route::get('/docentes/{docente}/edit', [DocenteController::class, 'edit'])->middleware(['auth', 'verified'])->name('docentes.edit');
Route::get('/novedades/{novedad}/edit', [ProyectosController::class, 'edit'])->middleware(['auth', 'verified'])->name('novedades.edit');
Route::get('/docentes/{docente}', [DocenteController::class, 'show'])->middleware(['auth', 'verified'])->name('docentes.show');
Route::get('/docentes/{docente}/estudios/{estudio}/edit', [EstudiosController::class, 'edit'])->middleware(['auth', 'verified'])->name('estudios.edit');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
