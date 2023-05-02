<?php

use App\Http\Controllers\ConceptoController;
use App\Http\Controllers\MontoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/conceptos', [ConceptoController::class, 'index']);

Route::post('/montos/crear', [MontoController::class, 'store']);
Route::get('/montos', [MontoController::class, 'index']);
Route::post('/montos/borrar', [MontoController::class, 'destroy']);
Route::post('/montos/actualizar', [MontoController::class, 'update']);