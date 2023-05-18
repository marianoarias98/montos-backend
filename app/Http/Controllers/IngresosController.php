<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingreso;

class IngresosController extends Controller
{
    public function show(Request $request) {
        $mes = $request->mes;
        $anio = $request->anio;
        $colegio =  $request->colegio_id;

        $ingreso = Ingreso::where('colegio_id', $colegio)
        ->where('mes', $mes)
        ->where('año', $anio)
        ->first();

        return response()->json($ingreso, 200);
    }

    public function store (Request $request) {

        $ingreso = new Ingreso;
        $ingreso->monto_aporte = $request->monto_aporte;
        $ingreso->monto_spep = $request->monto_spep;
        $ingreso->mes = $request->mes;
        $ingreso->año = $request->anio;
        $ingreso->colegio_id = $request->colegio_id;
        $ingreso->save();
        return response()->json(['message' => 'Ingreso registrado'], 200);
    }
}
