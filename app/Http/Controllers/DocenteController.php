<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docentes = Docente::all();
        return view('docentes.index', [
            'docentes' => $docentes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('docentes.create');
    }

    public function createStudies(Docente $docente)
    {
        return view('docentes.createstudies', [
            'docente' => $docente
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Docente $docente)
    {
        return view('docentes.show', [
            'docente' => $docente
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Docente $docente)
    {

        $this->authorize('update', $docente);

        return view('docentes.edit', [
            'docente' => $docente
        ]);
    }

    public function destroy(Docente $docente)
    {
        $docente->delete();

        session()->flash('mensaje', 'El Docente se elimino correctamente');

        return redirect()->route('docentes.index');
    }
}
