<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Novedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProyectosController extends Controller
{
    public function index()
    {
        $novedades = Novedad::all();
        return view('novedades.index', [
            'novedades' => $novedades
        ]);
    }

    public function create(Docente $docente)
    {
        return view('proyectos.create', [
            'docente' => $docente
        ]);
    }

    public function show(Novedad $novedad)
    {
        return view('novedades.show', [
            'novedad' => $novedad
        ]);
    }

    public function edit(Novedad $novedad)
    {

        $this->authorize('update', $novedad);

        return view('novedades.edit', [
            'novedad' => $novedad
        ]);
    }

    public function destroy(Novedad $novedad)
    {
        // Obtener el nombre del archivo PDF antes de eliminar la novedad
        $nombreArchivoPDF = $novedad->novedad_soportes;

        // Obtener el docente relacionado con la novedad
        $docente = $novedad->docente;

        if($novedad->novedad_tipo === 'Cursos Vacacionales' || $novedad->novedad_tipo === 'Seminario de Profundizacion') {
            $docente->docen_horastotales -= $novedad->novedad_horasfactor;
        } else {
            $docente->docen_horastotales -= $novedad->novedad_horas;
        }
        
        $docente->save();

        $novedad->delete();

        // Eliminar el archivo PDF asociado
        if ($nombreArchivoPDF) {
            Storage::delete('public/pdf/' . $nombreArchivoPDF);
        }

        session()->flash('mensaje', 'La Novedad se elimino correctamente');

        return redirect()->route('novedades.index');
    }
}
