<?php

namespace App\Livewire;

use App\Models\Nivel;
use App\Models\Docente;
use Livewire\Component;
use App\Models\Divipola;
use App\Models\Estudios;
use App\Models\TipoDocente;
use App\Models\Clasificacion;

class CrearDocente extends Component
{

    public $documento;
    public $lugar_expedicion;
    public $nombres;
    public $lugar_residencia;
    public $telefono;
    public $correo_institucional;
    public $correo_personal;
    public $tipo_docente;
    public $cdpr;
    public $clasificacion_especial;
    public $cdpra;
    public $cdprf;
    public $cdpo;
    public $nivel_estudios;
    public $nombre_titulo;
    public $universidad;
    // public $fecha_grado;
    public $perfil_completo;

    protected $rules = [
        'documento' => 'required|numeric|digits_between:6,12|unique:docentes,docen_documento',
        'lugar_expedicion' => 'required',
        'nombres' => 'required|string|regex:/^[\pL\s]+$/u',
        'lugar_residencia' => 'required',
        'telefono' => 'required|numeric|unique:docentes,docen_telefono',
        'correo_institucional' => 'required|email|unique:docentes,docen_correoinst', 
        'correo_personal' => 'required|email|unique:docentes,docen_correopersonal',
        'tipo_docente' => 'required',
        'cdpr' => 'required',
        'clasificacion_especial' => 'nullable',
        'cdpra' => 'required|numeric',
        'cdprf' => 'required',
        'cdpo' => 'nullable|string|regex:/^[\pL\s]+$/u',
        'nivel_estudios' => 'required',
        'nombre_titulo' => 'required|string|regex:/^[\pL\s]+$/u',
        'universidad' => 'required|string|regex:/^[\pL\s]+$/u',
        // 'fecha_grado' => 'required',
        'perfil_completo' => 'nullable'
    ];

    public function crearDocente() 
    {
        $datos = $this->validate();

        $datos['clasificacion_especial'] = $datos['clasificacion_especial'] !== '' ? $datos['clasificacion_especial'] : null;
        $datos['cdpo'] = $datos['cdpo'] !== '' ? $datos['cdpo'] : null;

        // Crear Docente

        // dd($datos);

        $docente = Docente::create([
            'docen_documento' => $datos['documento'],
            'docen_lugarexpdoc' => $datos['lugar_expedicion'],
            'docen_nombre' => $datos['nombres'],
            'docen_lugarresidencia' => $datos['lugar_residencia'],
            'docen_telefono' => $datos['telefono'],
            'docen_correoinst' => $datos['correo_institucional'],
            'docen_correopersonal' => $datos['correo_personal'],
            'docen_tipo' => $datos['tipo_docente'],
            'docen_clasificacionpregrado' => $datos['cdpr'],
            'docen_clasificacionpregradoespecial' => $datos['clasificacion_especial'] ?? null,
            'docen_actaclasificacionpregrado' => $datos['cdpra'],
            'docen_fechaclasificacion' => $datos['cdprf'],
            'docen_clasificacionposgrado' => $datos['cdpo'] ?? null,
            'docen_perfilcompleto' => $datos['perfil_completo'] ?? null,
            'user_id' => auth()->user()->id
            
        ]);

        // Obtener el ID del docente recién creado
        $docenteId = $docente->id;

        Estudios::create([
            'id_docen' => $docenteId, // Asigna el ID del docente recién creado
            'id_nacad' => $datos['nivel_estudios'],
            'estud_titulo' => $datos['nombre_titulo'],
            'estud_universidad' => $datos['universidad'],
            // 'estud_fechagrado' => $datos['fecha_grado'],
            'user_id' => auth()->user()->id
            
        ]);

        // Crear un mensaje
        session()->flash('mensaje', 'El Docente se ingreso correctamente');

        // Redireccionar al usuario
        return redirect()->route('docentes.index');

    }

    public function render()
    {
        // Consultar BD
        $clasificacion = Clasificacion::all();
        $divipola = Divipola::all();
        $nivel = Nivel::all();
        $tipo = TipoDocente::all();

        return view('livewire.crear-docente', [
            'clasificaciones' => $clasificacion,
            'divipola_' => $divipola,
            'niveles' => $nivel,
            'tipos' => $tipo
        ]);
    }
}
