<?php

namespace App\Livewire;

use App\Models\Nivel;
use App\Models\Docente;
use Livewire\Component;
use App\Models\Estudios;

class CrearEstudiosDocente extends Component
{

    public $docente_id;
    public $documento;
    public $nombres;
    public $nivel_estudios;
    public $nombre_titulo;
    public $universidad;
    // public $fecha_grado;

    protected $rules = [
        'nivel_estudios' => 'required',
        'nombre_titulo' => 'required|string|regex:/^[\pL\s]+$/u',
        'universidad' => 'required|string|regex:/^[\pL\s]+$/u'
        // 'fecha_grado' => 'required'
    ];

    public function mount(Docente $docente)
    {
        $this->docente_id = $docente->id;
        $this->documento = $docente->docen_documento;
        $this->nombres = $docente->docen_nombre;
    }

    public function crearEstudios()
    {
        
        $datos = $this->validate();

        // Crear Estudios

        Estudios::create([
            'id_docen' => $this->docente_id,
            'id_nacad' => $datos['nivel_estudios'],
            'estud_titulo' => $datos['nombre_titulo'],
            'estud_universidad' => $datos['universidad'],
            // 'estud_fechagrado' => $datos['fecha_grado'],
            'user_id' => auth()->user()->id
        ]);

        // Crear un mensaje
        session()->flash('mensaje', 'Los Estudios se ingresaron correctamente');

        // Redireccionar al usuario
        return redirect()->route('docentes.index');

    }

    public function render()
    {

        $nivel = Nivel::all();

        return view('livewire.crear-estudios-docente', [
            'niveles' => $nivel,
        ]);
    }
}
