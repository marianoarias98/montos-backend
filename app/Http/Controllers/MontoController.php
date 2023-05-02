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
    public function index()
    {
        $montos = Monto::join('conceptos', 'conceptos.id', '=', 'montos.concepto_id')
        ->select('montos.*', 'conceptos.nombre as nombre', 'conceptos.codigo as codigo')->get();
        // $montos = Monto::all();

        return response()->json($montos, 200);
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
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
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
