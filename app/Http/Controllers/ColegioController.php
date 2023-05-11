<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colegio;

class ColegioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colegios = Colegio::all();
        return response()->json($colegios, 200);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $colegio = Colegio::findOrFail($id);
        return response()->json($colegio, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

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
    public function destroy(string $id)
    {
        //
    }
}
