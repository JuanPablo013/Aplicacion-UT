<?php

namespace App\Livewire;

use App\Models\Nivel;
use App\Models\Docente;
use App\Models\Estudios;
use Livewire\Component;

class EditarEstudio extends Component
{

    public $estudio_id;
    public $documento;
    public $nombres;
    public $nivel_estudios;
    public $nombre_titulo;
    public $universidad;
    // public $fecha_grado;

    protected $rules = [
        'nivel_estudios' => 'required',
        'nombre_titulo' => 'required|string|regex:/^[\pL\s]+$/u',
        'universidad' => 'required|string|regex:/^[\pL\s]+$/u',
        // 'fecha_grado' => 'required'
    ];

    public function mount(Docente $docente, Estudios $estudio)
    {
        $this->estudio_id = $estudio->id;
        $this->documento = $docente->docen_documento;
        $this->nombres = $docente->docen_nombre;
        $this->nivel_estudios = $estudio->id_nacad;
        $this->nombre_titulo = $estudio->estud_titulo;
        $this->universidad = $estudio->estud_universidad;
        // $this->fecha_grado = $estudio->estud_fechagrado;
    }

    public function editarEstudio()
    {
        $datos = $this->validate();

        // Encontrar el estudio a editar
        $estudio = Estudios::find($this->estudio_id);

        // Asignar los valores
        $estudio->id_nacad = $datos['nivel_estudios'];
        $estudio->estud_titulo = $datos['nombre_titulo'];
        $estudio->estud_universidad = $datos['universidad'];
        // $estudio->estud_fechagrado = $datos['fecha_grado'];

        // Guardar el docente
        $estudio->save();

        // Redireccionar
        session()->flash('mensaje', 'El Estudio se actualizó correctamente');

        return redirect()->route('docentes.index');

    }

    public function render()
    {

        // Consultar BD
        $nivel = Nivel::all();

        return view('livewire.editar-estudio', [
            'niveles' => $nivel
        ]);
    }
}
