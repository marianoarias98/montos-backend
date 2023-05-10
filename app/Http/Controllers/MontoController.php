<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Monto;

class MontoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $monto = Monto::findOrFail($id);
        return response()->json($monto, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $monto_id = $request->id;
        $monto = Monto::findOrFail($monto_id);
        $monto->delete();
        return response()->json(['Message' => 'Monto Eliminado'], 200);
    }
}
