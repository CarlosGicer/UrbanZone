<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Deporte;
use App\Models\Publicacion;
use App\Models\User;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class publicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::User()->rol == 'admin') {
            return view("admin.zonasAdmin", ['zonas' => Zona::paginate(13), 'deportes' => Deporte::all(), 'deporte_id' => null]);
        } else {
            return view("web.zonas", ['zonas' => Zona::paginate(6), 'deportes' => Deporte::all(), 'deporte_id' => null]);
        }
    }
    public function index2(Request $request)
    {

        return view("web.zonas", ['zonas' => Zona::where('nombre', $request->input('buscador'))->paginate(6), 'deportes' => Deporte::all(), 'deporte_id' => null]);
    }
    public function filtro_deporte(Deporte $deporte)
    {
        return view("web.zonas", ['zonas' => Zona::where('deporte_id', $deporte->id)->paginate(6), 'deportes' => Deporte::all(), 'deporte_id' => $deporte->id]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Zona $zona)
    {
        $usuario = Auth::user();

        return view("web.nuevaPublicacion", [
            'zona' => $zona,
            'deportes' => Deporte::all()
        ])->with('usuario', $usuario);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $publicacion = new Publicacion();
        $publicacion->titulo = $request->input('titulo');
        $publicacion->texto = $request->input('texto');
        $publicacion->multimedia = $request->input('multimedia');
        $publicacion->user_id = $request->input('user');
        $publicacion->zona_id = $request->input('zona');


        $path = $request->file('multimedia')->store('public');
        $publicacion->multimedia =  str_replace('public', 'storage', $path);
        $publicacion->save();
        return redirect('/zonas/publicaciones/' . $request->input('zona'));
    }





    /**
     * Display the specified resource.
     */
    public function show(Zona $zona)
    {
        if (Auth::User()->rol == 'admin') {
            return view("admin.zonaPublicacionesAdmin", ['zona' => $zona, 'deportes' => Deporte::all(), 'usuarios' => User::all(), 'publicaciones' =>  Publicacion::where('zona_id', $zona->id)->paginate(4), 'comentarios' => Comentario::all()]);
        } else {
            return view("web.zonaPublicaciones", ['zona' => $zona, 'deportes' => Deporte::all(), 'usuarios' => User::all(), 'publicaciones' =>  Publicacion::where('zona_id', $zona->id)->paginate(4), 'comentarios' => Comentario::all()]);
        }
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
