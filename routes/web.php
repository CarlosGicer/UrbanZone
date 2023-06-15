<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\publicacionController;
use App\Http\Controllers\zonaController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/zona/nueva', [zonaController::class, 'create']);
    Route::post('/zona/crear', [zonaController::class, 'store']);
    Route::get('/Inicio', [zonaController::class, 'index']);
    Route::get('/Inicio/{deporte}', [zonaController::class, 'filtro_deporte']);
    Route::get('/zonas', [publicacionController::class, 'index']);
    Route::get('/zonas/{deporte}', [publicacionController::class, 'filtro_deporte']);
    Route::get('/zonas/publicaciones/{zona}', [publicacionController::class, 'show']);
  
    //directamente de la zona 
    Route::get('/zonas/publicaciones/{zona}/nueva', [publicacionController::class, 'create']);
    //fuera de la zona
    Route::get('/zonas/publicaciones/nueva', [publicacionController::class, 'create2']);

    Route::post('/zona/publicaciones/crear', [publicacionController::class, 'store']);
    Route::post('/publicaciones/comentario/crear', [ComentarioController::class, 'store']);
   
});

require __DIR__ . '/auth.php';
