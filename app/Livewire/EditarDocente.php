<?php

namespace App\Livewire;

use App\Models\Docente;
use Livewire\Component;
use App\Models\Divipola;
use App\Models\TipoDocente;
use App\Models\Clasificacion;

class EditarDocente extends Component
{

    public $docente_id;
    public $documento;
    public $lugar_expedicion;
    public $nombres;
    public $lugar_residencia;
    public $telefono;
    public $correo_institucional;
    public $correo_personal;
    public $tipo_docente;
    public $cdpr;
    public $cdpra;
    public $cdprf;
    public $cdpo;
    public $perfil_completo;

    protected $rules = [
        // 'documento' => 'required|numeric',
        'lugar_expedicion' => 'required',
        'nombres' => 'required|string|regex:/^[\pL\s]+$/u',
        'lugar_residencia' => 'required',
        'telefono' => 'required|numeric',
        'correo_institucional' => 'required|email',
        'correo_personal' => 'required|email',
        'tipo_docente' => 'required',
        'cdpr' => 'required',
        'cdpra' => 'required|numeric',
        'cdprf' => 'required',
        'cdpo' => 'nullable|string|regex:/^[\pL\s]+$/u',
        'perfil_completo' => 'required|string|regex:/^[\pL\s]+$/u'
    ];

    public function mount(Docente $docente)
    {
        $this->docente_id = $docente->id;
        $this->documento = $docente->docen_documento;
        $this->lugar_expedicion = $docente->docen_lugarexpdoc;
        $this->nombres = $docente->docen_nombre;
        $this->lugar_residencia = $docente->docen_lugarresidencia;
        $this->telefono = $docente->docen_telefono;
        $this->correo_institucional = $docente->docen_correoinst;
        $this->correo_personal = $docente->docen_correopersonal;
        $this->tipo_docente = $docente->docen_tipo;
        $this->cdpr = $docente->docen_clasificacionpregrado;
        $this->cdpra = $docente->docen_actaclasificacionpregrado;
        $this->cdprf = $docente->docen_fechaclasificacion;
        $this->cdpo = $docente->docen_clasificacionposgrado;
        $this->perfil_completo = $docente->docen_perfilcompleto;
    }

    public function editarDocente()
    {
        $datos = $this->validate();

        $datos['cdpo'] = $datos['cdpo'] !== '' ? $datos['cdpo'] : null;

        // Encontrar el docente a editar
        $docente = Docente::find($this->docente_id);

        // Asignar los valores
        // $docente->docen_documento = $datos['documento'];
        $docente->docen_lugarexpdoc = $datos['lugar_expedicion'];
        $docente->docen_nombre = $datos['nombres'];
        $docente->docen_lugarresidencia = $datos['lugar_residencia'];
        $docente->docen_telefono = $datos['telefono'];
        $docente->docen_correoinst = $datos['correo_institucional'];
        $docente->docen_correopersonal = $datos['correo_personal'];
        $docente->docen_tipo = $datos['tipo_docente'];
        $docente->docen_clasificacionpregrado = $datos['cdpr'];
        $docente->docen_actaclasificacionpregrado = $datos['cdpra'];
        $docente->docen_fechaclasificacion = $datos['cdprf'];
        $docente->docen_clasificacionposgrado = $datos['cdpo'] ?? null;
        $docente->docen_perfilcompleto = $datos['perfil_completo'];

        // Guardar el docente
        $docente->save();

        // Redireccionar
        session()->flash('mensaje', 'El Docente se actualizó correctamente');

        return redirect()->route('docentes.index');

    }

    public function render()
    {

        // Consultar BD
        $clasificacion = Clasificacion::all();
        $divipola = Divipola::all();
        $docente = Docente::find($this->docente_id);
        $tipo = TipoDocente::all();

        return view('livewire.editar-docente', [
            'clasificaciones' => $clasificacion,
            'divipola_' => $divipola,
            'docentes' => $docente,
            'tipos' => $tipo
        ]);
    }
}
