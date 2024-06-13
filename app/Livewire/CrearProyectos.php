<?php

namespace App\Livewire;

use App\Models\Cat;
use App\Models\Docente;
use App\Models\Novedad;
use Livewire\Component;
use App\Models\Programas;
use App\Models\TipoNovedad;
use Livewire\WithFileUploads;

class CrearProyectos extends Component
{

    use WithFileUploads;

    public $docente_id;
    public $documentoynombre_docente;
    public $tipo_novedad;
    public $codigo_programa;
    public $codigo_cat;
    public $semestre;
    public $numero_grupo;
    public $codigo_asignatura;
    public $nombre_asignatura;
    public $total_horas;
    public $numero_estudiantes;
    public $desplazamiento;
    public $numero_desplazamientos;
    public $observacion;
    public $fecha_inicio;
    public $fecha_final;
    public $pdf;
    public $horas_totales;

    protected $rules = [
        'tipo_novedad' => 'required',
        'codigo_programa' => 'required',
        'docente_id' => 'required|numeric',
        'codigo_cat' => 'required|numeric',
        'semestre' => 'required',
        'numero_grupo' => 'required',
        'codigo_asignatura' => 'required',
        'nombre_asignatura' => 'required|string|regex:/^[\pL\s]+$/u',
        'total_horas' => 'required|numeric|gt:0',
        'numero_estudiantes' => 'required',
        'desplazamiento' => 'nullable|regex:/^[\pL\s]+$/u',
        'numero_desplazamientos' => 'nullable|string',
        'observacion' => 'nullable|string',
        'fecha_inicio' => 'required',
        'fecha_final' => 'required',
        'pdf' => 'required|mimes:pdf'
    ];

    public function mount(Docente $docente)
    {
        $this->docente_id = $docente->id;
        $this->documentoynombre_docente = $docente->docen_documento . ' - ' . $docente->docen_nombre;
        $this->horas_totales = $docente->docen_horastotales;
    }

    public function crearProyecto() 
    {
        $datos = $this->validate();

        $datos['desplazamiento'] = $datos['desplazamiento'] !== '' ? $datos['desplazamiento'] : null;
        $datos['numero_desplazamientos'] = $datos['numero_desplazamientos'] !== '' ? $datos['numero_desplazamientos'] : null;
        $datos['observacion'] = $datos['observacion'] !== '' ? $datos['observacion'] : null;

        $docente = Docente::find($this->docente_id);
        $novedad = $datos['tipo_novedad'];
        $trabajo_grado = ['Horas de Trabajo de Grado Pregrado y Especializacion', 'Horas de Trabajo de Grado Maestria y Doctorado'];
        $horas = $datos['total_horas'];
        $numero_estudiantes = $datos['numero_estudiantes'];

        if ($docente) {
            $tipo_docente = $docente->docen_tipo;
            $horas_docente = $docente->docen_horastotales;
            $horas_semestre = $docente->tipoDocente->docen_horassemestre;
            $nombre_tipodocente = $docente->tipoDocente->docen_nombre;
            $docente_id = $docente->id;
        } else {
            echo "El docente no fue encontrado";
        }

        $tipo_novedad = new TipoNovedad();
        $novedad_tipo = new Novedad();

        $error = null;
        $valor_calculado = null;
        $error_tipo = null;
        $suma_horas_novedad = null;
        $error_horas_tipo = null;

        switch ($novedad) {
            case 'Cursos Vacacionales':
                $error = $tipo_novedad->validarCursosPorHorasIguales($horas, $novedad);
                $valor_calculado = $tipo_novedad->validarHorasPorFactor($numero_estudiantes, $novedad);
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $valor_calculado, $nombre_tipodocente);
                break;
            case 'Proyecto de Investigacion':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad);
                $error_horas_tipo = $novedad_tipo->validarMaximoHoras($suma_horas_novedad, $horas, $novedad);
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break;
            case 'Semillero de Investigacion':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad);
                $error_horas_tipo = $novedad_tipo->validarMaximoHoras($suma_horas_novedad, $horas, $novedad);
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break;
            case 'Grupo de Investigacion':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad);
                $error_horas_tipo = $novedad_tipo->validarMaximoHoras($suma_horas_novedad, $horas, $novedad);
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break;
            case 'Proyeccion Social':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad);
                $error_horas_tipo = $novedad_tipo->validarMaximoHoras($suma_horas_novedad, $horas, $novedad);
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break;
            case 'Representacion CD':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad);
                $error_horas_tipo = $novedad_tipo->validarMaximoHoras($suma_horas_novedad, $horas, $novedad);
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break;
            case 'Representacion CA':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad);
                $error_horas_tipo = $novedad_tipo->validarMaximoHoras($suma_horas_novedad, $horas, $novedad);
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break;
            case 'Horas de Comite':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad);
                $error_horas_tipo = $novedad_tipo->validarMaximoHoras($suma_horas_novedad, $horas, $novedad);
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break;
            case 'Horas de Trabajo de Grado Pregrado y Especializacion':
                $error = $tipo_novedad->validarCursosPorHorasProceso($horas, $novedad);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedadTG($docente_id, $trabajo_grado);
                $error_horas_tipo = $novedad_tipo->validarMaximoHoras($suma_horas_novedad, $horas, $novedad);
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break;
            case 'Horas de Trabajo de Grado Maestria y Doctorado':
                $error = $tipo_novedad->validarCursosPorHorasProceso($horas, $novedad);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedadTG($docente_id, $trabajo_grado);
                $error_horas_tipo = $novedad_tipo->validarMaximoHoras($suma_horas_novedad, $horas, $novedad);
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break;
            case 'Jurados de Opcion de Grado Pregrado y Especializacion':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad);
                $error_horas_tipo = $novedad_tipo->validarMaximoHoras($suma_horas_novedad, $horas, $novedad);
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break;    
            case 'Jurados de Opcion de Grado Maestria y Doctorado':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad);
                $error_horas_tipo = $novedad_tipo->validarMaximoHoras($suma_horas_novedad, $horas, $novedad);
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break; 
            case 'Jurados de Convocatoria Docente':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad);
                $error_horas_tipo = $novedad_tipo->validarMaximoHoras($suma_horas_novedad, $horas, $novedad);
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break;     
            case 'Elaboracion Portafolio':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad);
                $error_horas_tipo = $novedad_tipo->validarMaximoHoras($suma_horas_novedad, $horas, $novedad);
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break; 
            case 'Diseño de Cursos Virtuales':
                $error = $tipo_novedad->validarCursosPorHorasProceso($horas, $novedad);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad);
                $error_horas_tipo = $novedad_tipo->validarMaximoHoras($suma_horas_novedad, $horas, $novedad);
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break; 
            case 'Estudios de Homologacion':
                $error = $tipo_novedad->validarCursosPorHorasProceso($horas, $novedad);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad);
                $error_horas_tipo = $novedad_tipo->validarMaximoHoras($suma_horas_novedad, $horas, $novedad);
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break; 
            case 'Validacion o Convocatoria':
                $error = $tipo_novedad->validarCursosPorHorasProceso($horas, $novedad);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad);
                $error_horas_tipo = $novedad_tipo->validarMaximoHoras($suma_horas_novedad, $horas, $novedad);
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break; 
            case 'Diplomado':
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break; 
            case 'Seminario de Docencia':
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break; 
            case 'Seminario de Profundizacion':
                $error = $tipo_novedad->validarCursosPorHorasIguales($horas, $novedad);
                $valor_calculado = $tipo_novedad->validarHorasPorFactor($numero_estudiantes, $novedad);
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $valor_calculado, $nombre_tipodocente);
                break; 
            case 'Catedra Posgrado':
                $valor_calculado = $horas;
                $error_tipo = $tipo_novedad->validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente);
                break; 
            default:
                $error = null; // En caso de que no haya validaciones específicas para el tipo de novedad
                break;
        }

        // dd($);

        if ($error) {
            $this->addError('total_horas', $error);
            return;
        }

        if ($error_tipo) {
            $this->addError('total_horas', $error_tipo);
            return;
        }

        if ($error_horas_tipo) {
            $this->addError('total_horas', $error_horas_tipo);
            return;
        }

        // Sumar las horas totales del formulario a las horas totales del docente
        $suma_horas = $docente->docen_horastotales += $valor_calculado;

        // Almacenar PDF
        $pdf = $this->pdf->store('public/pdf');
        $datos['pdf'] = str_replace('public/pdf/', '', $pdf);

        if($datos['tipo_novedad'] === 'Cursos Vacacionales' || $datos['tipo_novedad'] === 'Seminario de Profundizacion') {
            $valor_horasfactor = $valor_calculado;
        } else {
            $valor_horasfactor = null;
        }

        Novedad::create([
            'novedad_tipo' => $datos['tipo_novedad'],
            'novedad_codigoprograma' => $datos['codigo_programa'],
            'novedad_docente' => $this->docente_id,
            'novedad_codigocat' => $datos['codigo_cat'],
            'novedad_semestre' => $datos['semestre'],
            'novedad_grupo' => $datos['numero_grupo'],
            'novedad_codigoasignatura' => $datos['codigo_asignatura'],
            'novedad_nombreasignatura' => $datos['nombre_asignatura'],
            'novedad_horas' => $datos['total_horas'],
            'novedad_horasfactor' => $valor_horasfactor,
            'novedad_numeroestudiantes' => $datos['numero_estudiantes'],
            'novedad_desplazamiento' => $datos['desplazamiento'],
            'novedad_numerodesplazamiento' => $datos['numero_desplazamientos'],
            'novedad_observacion' => $datos['observacion'],
            'novedad_fechainicio' => $datos['fecha_inicio'],
            'novedad_fechafin' => $datos['fecha_final'],
            'novedad_soportes' => $datos['pdf'],
            'user_id' => auth()->user()->id
        ]);

        $docente->docen_horastotales = $suma_horas;
        $docente->save();

        // Crear un mensaje
        session()->flash('mensaje', 'La Novedad se ingreso correctamente');

        // Redireccionar al usuario
        return redirect()->route('novedades.index');

    }

    public function render()
    {

        $programa = Programas::all();
        $cat = Cat::all();
        $novedad = TipoNovedad::all();

        return view('livewire.crear-proyectos', [
            'programas' => $programa,
            'cats' => $cat,
            'novedades' => $novedad
        ]);
    }
}
