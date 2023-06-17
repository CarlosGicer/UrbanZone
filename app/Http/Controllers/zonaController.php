<?php

namespace App\Http\Controllers;

use App\Models\Deporte;
use App\Models\Zona;
use Illuminate\Http\Request;

class zonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("web.inicio", ['zonas'=>Zona::all(), 'deportes'=>Deporte::all(), 'deporte_id'=>null]);
    }
    public function filtro_deporte(Deporte $deporte)
    {
        return view("web.inicio", ['zonas'=>Zona::all(),'deportes'=>Deporte::all(), 'deporte_id'=>$deporte->id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("web.nuevaZona", ['zonas'=>Zona::all(), 'deportes'=>Deporte::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $zona = new Zona();
        $zona->nombre = $request->input('nombre');
        $zona->latitud = $request->input('latitud');
        $zona->longitud = $request->input('longitud');
        $zona->deporte_id = $request->input('deporte_id');

        $path = $request->file('imagen')->store('public');
        $zona->imagen =  str_replace('public', 'storage', $path);
        $zona->save();
        return redirect('/Inicio');
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
    public function destroy(string $id)
    {
        //
    }
}
