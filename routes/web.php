<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadosController;



Route::get('/', [EmpleadosController::class, 'index'])->name('home'); // Página principal: Lista todos los empleados
Route::post('/store', [EmpleadosController::class, 'store'])->name('myStore'); // Guarda un nuevo empleado en la base de datos
Route::get('/empleado/show/{id}', [EmpleadosController::class, 'show'])->name('myShow'); // Muestra detalles de un empleado específico (por ID)
Route::delete('/empleado/delete/{id}', [EmpleadosController::class, 'destroy'])->name('myDestroy'); // Elimina un empleado (por ID)
Route::get('/empleado/edit/{id}', [EmpleadosController::class, 'edit'])->name('myEdit'); // Muestra el formulario para editar un empleado (por ID)
Route::put('/empleado/update/{id}', [EmpleadosController::class, 'update'])->name('myUpdate'); // Actualiza un empleado existente (por ID) usando PUT
Route::post('/empleado/update/{id}', [EmpleadosController::class, 'update']); // Actualiza un empleado existente (por ID) usando POST (compatibilidad)
Route::get('/empleado/confirm-delete/{id}', [EmpleadosController::class, 'confirmDelete'])->name('empleados.confirm-delete'); // Muestra ventana/modal de confirmación antes de eliminar