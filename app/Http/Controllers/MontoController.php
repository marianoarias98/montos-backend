<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Monto;

class MontoController extends Controller
{

    public function index(Request $request)
    {
        $mes = $request->mes;
        $anio = $request->anio;
        $colegio =  $request->colegio_id;

        $montos = Monto::join('conceptos', 'conceptos.id', '=', 'montos.concepto_id')
            ->select('montos.*', 'conceptos.nombre as nombre', 'conceptos.codigo as codigo')
            ->where('montos.mes', $mes)
            ->where('montos.año', $anio)
            ->where('montos.colegio_id', $colegio)
            ->orderBy('montos.concepto_id')
            ->get();

        $sumatorias = Monto::selectRaw('SUM(personal) as suma_personal, SUM(patronal) as suma_patronal,SUM(total) as suma_total')
            ->where('montos.mes', $mes)
            ->where('montos.año', $anio)
            ->where('montos.colegio_id', $colegio)
            ->get();

        return response()->json([
            'montos' => $montos,
            'sumatorias' => $sumatorias
        ]);
    }

    public function store(Request $request)
    {
        $monto = new Monto;
        $monto->concepto_id = $request->concepto_id;
        $monto->colegio_id = $request->colegio_id;
        $monto->personal = $request->personal;
        $monto->patronal = $request->patronal;
        $monto->total = $request->total;
        $monto->mes = $request->mes;
        $monto->año = $request->año;
        $monto->save();
        return response()->json(['message'  => 'Success'], 200);
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $monto = Monto::findOrFail($id);
        return response()->json($monto, 200);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $monto = Monto::findOrFail($id);
        $monto->concepto_id = $request->concepto_id;
        $monto->colegio_id = $request->colegio_id;
        $monto->personal = $request->personal;
        $monto->patronal = $request->patronal;
        $monto->total = $request->total;
        $monto->mes = $request->mes;
        $monto->año = $request->año;
        $monto->save();
        return response()->json(['message' => 'Monto editado con exito'], 200);
    }

    public function destroy(Request $request)
    {
        $monto_id = $request->id;
        $monto = Monto::findOrFail($monto_id);
        $monto->delete();
        return response()->json(['Message' => 'Monto Eliminado'], 200);
    }

    public function indexAll(Request $request)
    {
        $mes = $request->mes;
        $año = $request->año;

        $montos = DB::table('montos')
            ->join('colegios', 'montos.colegio_id', '=', 'colegios.id')
            ->select('montos.colegio_id', 'montos.mes', 'montos.año', DB::raw('SUM(montos.personal) AS sum_personal'), DB::raw('SUM(montos.patronal) AS sum_patronal'), DB::raw('SUM(montos.total) as sum_total'), 'colegios.nombre as nombre')
            ->where('montos.mes', $mes)
            ->where('montos.año', $año)
            ->groupBy('montos.colegio_id', 'montos.mes', 'montos.año', 'colegios.nombre')
            ->get();

        return response()->json($montos, 200);
    }
}
