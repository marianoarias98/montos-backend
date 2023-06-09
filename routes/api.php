<?php

use App\Http\Controllers\ConceptoController;
use App\Http\Controllers\MontoController;
use App\Http\Controllers\ColegioController;
use App\Http\Controllers\IngresosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/conceptos', [ConceptoController::class, 'index']);

Route::post('colegios', [ColegioController::class, 'index']);
Route::post('/colegio', [ColegioController::class, 'show']);

Route::post('/montos/crear', [MontoController::class, 'store']);
Route::post('/montos', [MontoController::class, 'index']);
Route::post('/montos/borrar', [MontoController::class, 'destroy']);
Route::post('/montos/actualizar', [MontoController::class, 'update']);
Route::post('/monto', [MontoController::class, 'show']);
Route::post('/montos/listado', [MontoController::class, 'indexAll']);

Route::post('/ingreso', [IngresosController::class, 'show']);
Route::post('/ingreso/crear', [IngresosController::class, 'store']);
Route::post('/ingreso/actualizar', [IngresosController::class, 'update']);