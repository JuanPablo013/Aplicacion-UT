<?php

namespace App\Livewire;

use App\Models\Cat;
use App\Models\Docente;
use App\Models\Novedad;
use Livewire\Component;
use App\Models\Programas;
use App\Models\TipoNovedad;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditarNovedad extends Component
{

    use WithFileUploads;

    public $docente_id;
    public $novedad_id;
    public $tipo_novedad;
    public $codigo_programa;
    public $documentoynombre_docente;
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

    protected $rules = [
        'tipo_novedad' => 'required',
        'codigo_programa' => 'required',
        'codigo_cat' => 'required|numeric',
        'semestre' => 'required',
        'numero_grupo' => 'required',
        'codigo_asignatura' => 'required',
        'nombre_asignatura' => 'required|string|regex:/^[\pL\s]+$/u',
        'total_horas' => 'required|numeric|gt:0',
        'numero_estudiantes' => 'required',
        'desplazamiento' => 'nullable|string|regex:/^[\pL\s]+$/u',
        'numero_desplazamientos' => 'nullable|string',
        'observacion' => 'nullable|string',
        'fecha_inicio' => 'required',
        'fecha_final' => 'required',
        'pdf' => 'required|mimes:pdf'    
    ];

    public function mount(Novedad $novedad)
    {
        $this->docente_id = $novedad->docente->id;
        $this->novedad_id = $novedad->id;
        $this->documentoynombre_docente = $novedad->docente->docen_documento . ' - ' . $novedad->docente->docen_nombre;
        $this->tipo_novedad = $novedad->novedad_tipo;
        $this->codigo_programa = $novedad->novedad_codigoprograma;
        $this->codigo_cat = $novedad->novedad_codigocat;
        $this->semestre = $novedad->novedad_semestre;
        $this->numero_grupo = $novedad->novedad_grupo;
        $this->codigo_asignatura = $novedad->novedad_codigoasignatura;
        $this->nombre_asignatura = $novedad->novedad_nombreasignatura;
        $this->total_horas = $novedad->novedad_horas;
        $this->numero_estudiantes = $novedad->novedad_numeroestudiantes;
        $this->desplazamiento = $novedad->novedad_desplazamiento;
        $this->numero_desplazamientos = $novedad->novedad_numerodesplazamiento;
        $this->observacion = $novedad->novedad_observacion;
        $this->fecha_inicio = $novedad->novedad_fechainicio;
        $this->fecha_final = $novedad->novedad_fechafin;
    }

    public function editarProyecto()
    {
        $datos = $this->validate();

        $datos['desplazamiento'] = $datos['desplazamiento'] !== '' ? $datos['desplazamiento'] : null;
        $datos['numero_desplazamientos'] = $datos['numero_desplazamientos'] !== '' ? $datos['numero_desplazamientos'] : null;
        $datos['observacion'] = $datos['observacion'] !== '' ? $datos['observacion'] : null;

        $docente = Docente::find($this->docente_id);
        $novedad = Novedad::find($this->novedad_id);
        $novedad_nombre = $datos['tipo_novedad'];
        $novedad_horas_actual = $novedad->novedad_horas;
        $novedad_horasfactor = $novedad->novedad_horasfactor;
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
        $error_tipo = null;
        $suma_horas_novedad = null;
        $error_horas_tipo = null;

        switch ($novedad_nombre) {
            case 'Cursos Vacacionales':
                $valor_calculado = $tipo_novedad->validarEdicionHorasPorFactor($numero_estudiantes, $horas);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break;
            case 'Proyecto de Investigacion':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad_nombre);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad_nombre);
                $error_horas_tipo = $novedad_tipo->validarEdicionMaximoHoras($novedad_horas_actual,$suma_horas_novedad, $horas, $novedad_nombre);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break;
            case 'Semillero de Investigacion':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad_nombre);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad_nombre);
                $error_horas_tipo = $novedad_tipo->validarEdicionMaximoHoras($novedad_horas_actual,$suma_horas_novedad, $horas, $novedad_nombre);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break;
            case 'Grupo de Investigacion':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad_nombre);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad_nombre);
                $error_horas_tipo = $novedad_tipo->validarEdicionMaximoHoras($novedad_horas_actual,$suma_horas_novedad, $horas, $novedad_nombre);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break;
            case 'Proyeccion Social':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad_nombre);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad_nombre);
                $error_horas_tipo = $novedad_tipo->validarEdicionMaximoHoras($novedad_horas_actual,$suma_horas_novedad, $horas, $novedad_nombre);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break;
            case 'Representacion CD':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad_nombre);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad_nombre);
                $error_horas_tipo = $novedad_tipo->validarEdicionMaximoHoras($novedad_horas_actual, $suma_horas_novedad, $horas, $novedad_nombre);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break;
            case 'Representacion CA':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad_nombre);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad_nombre);
                $error_horas_tipo = $novedad_tipo->validarEdicionMaximoHoras($novedad_horas_actual,$suma_horas_novedad, $horas, $novedad_nombre);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break;
            case 'Horas de Comite':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad_nombre);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad_nombre);
                $error_horas_tipo = $novedad_tipo->validarEdicionMaximoHoras($novedad_horas_actual,$suma_horas_novedad, $horas, $novedad_nombre);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break;
            case 'Horas de Trabajo de Grado Pregrado y Especializacion':
                $error = $tipo_novedad->validarCursosPorHorasProceso($horas, $novedad_nombre);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedadTG($docente_id, $trabajo_grado);
                $error_horas_tipo = $novedad_tipo->validarEdicionMaximoHorasTG($novedad_horas_actual, $suma_horas_novedad, $horas, $novedad_nombre);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break;
            case 'Horas de Trabajo de Grado Maestria y Doctorado':
                $error = $tipo_novedad->validarCursosPorHorasProceso($horas, $novedad_nombre);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedadTG($docente_id, $trabajo_grado);
                $error_horas_tipo = $novedad_tipo->validarEdicionMaximoHorasTG($novedad_horas_actual, $suma_horas_novedad, $horas, $novedad_nombre);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break;
            case 'Jurados de Opcion de Grado Pregrado y Especializacion':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad_nombre);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad_nombre);
                $error_horas_tipo = $novedad_tipo->validarEdicionMaximoHoras($novedad_horas_actual,$suma_horas_novedad, $horas, $novedad_nombre);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break;    
            case 'Jurados de Opcion de Grado Maestria y Doctorado':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad_nombre);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad_nombre);
                $error_horas_tipo = $novedad_tipo->validarEdicionMaximoHoras($novedad_horas_actual,$suma_horas_novedad, $horas, $novedad_nombre);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break; 
            case 'Jurados de Convocatoria Docente':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad_nombre);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad_nombre);
                $error_horas_tipo = $novedad_tipo->validarEdicionMaximoHoras($novedad_horas_actual,$suma_horas_novedad, $horas, $novedad_nombre);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break;     
            case 'Elaboracion Portafolio':
                $error = $tipo_novedad->validarCursosPorHorasSemestre($horas, $novedad_nombre);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad_nombre);
                $error_horas_tipo = $novedad_tipo->validarEdicionMaximoHoras($novedad_horas_actual,$suma_horas_novedad, $horas, $novedad_nombre);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break; 
            case 'Diseño de Cursos Virtuales':
                $error = $tipo_novedad->validarCursosPorHorasProceso($horas, $novedad_nombre);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad_nombre);
                $error_horas_tipo = $novedad_tipo->validarEdicionMaximoHoras($novedad_horas_actual,$suma_horas_novedad, $horas, $novedad_nombre);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break; 
            case 'Estudios de Homologacion':
                $error = $tipo_novedad->validarCursosPorHorasProceso($horas, $novedad_nombre);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad_nombre);
                $error_horas_tipo = $novedad_tipo->validarEdicionMaximoHoras($novedad_horas_actual,$suma_horas_novedad, $horas, $novedad_nombre);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break; 
            case 'Validacion o Convocatoria':
                $error = $tipo_novedad->validarCursosPorHorasProceso($horas, $novedad_nombre);
                $suma_horas_novedad = $novedad_tipo->sumarHorasPorTipoNovedad($docente_id, $novedad_nombre);
                $error_horas_tipo = $novedad_tipo->validarEdicionMaximoHoras($novedad_horas_actual,$suma_horas_novedad, $horas, $novedad_nombre);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break; 
            case 'Diplomado':
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break; 
            case 'Seminario de Docencia':
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break; 
            case 'Seminario de Profundizacion':
                $error = $tipo_novedad->validarCursosPorHorasIguales($horas, $novedad_nombre);
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break; 
            case 'Catedra Posgrado':
                $error_tipo = $tipo_novedad->validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente);
                break; 
            default:
                $error = null; // En caso de que no haya validaciones específicas para el tipo de novedad
                break;
        }

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

        if($novedad->novedad_tipo === 'Cursos Vacacionales') {
            $nueva_horaporfactor = $docente->docen_horastotales -= $novedad_horasfactor;
            $nueva_horaporfactorfinal = $nueva_horaporfactor += $valor_calculado;
            $docente->docen_horastotales = $nueva_horaporfactorfinal;
        } else {
            $nueva_hora = $docente->docen_horastotales -= $novedad->novedad_horas;
            $hora_final = $nueva_hora += $datos['total_horas'];
            // Sumar las horas totales del formulario a las horas totales del docente
            $docente->docen_horastotales = $hora_final;
        }

        $docente->save();

        if ($novedad->novedad_soportes) {
            Storage::delete('public/pdf/' . $novedad->novedad_soportes);
        }

        $pdf = $this->pdf->store('public/pdf');
        $datos['pdf'] = str_replace('public/pdf/', '', $pdf);

        $novedad->novedad_tipo = $datos['tipo_novedad'];
        $novedad->novedad_codigoprograma = $datos['codigo_programa'];
        $novedad->novedad_codigocat = $datos['codigo_cat'];
        $novedad->novedad_semestre = $datos['semestre'];
        $novedad->novedad_grupo = $datos['numero_grupo'];
        $novedad->novedad_codigoasignatura = $datos['codigo_asignatura'];
        $novedad->novedad_nombreasignatura = $datos['nombre_asignatura'];
        $novedad->novedad_horas = $datos['total_horas'];
        if($novedad->novedad_tipo === 'Cursos Vacacionales') {
            $novedad->novedad_horasfactor = $valor_calculado;
        } else {
            $novedad->novedad_horasfactor = null;
        }
        $novedad->novedad_numeroestudiantes = $datos['numero_estudiantes'];
        $novedad->novedad_desplazamiento = $datos['desplazamiento'];
        $novedad->novedad_numerodesplazamiento = $datos['numero_desplazamientos'];
        $novedad->novedad_observacion = $datos['observacion'];
        $novedad->novedad_fechainicio = $datos['fecha_inicio'];
        $novedad->novedad_fechafin = $datos['fecha_final'];
        $novedad->novedad_soportes = $datos['pdf'];

        $novedad->save();

        session()->flash('mensaje', 'La Novedad se actualizó correctamente');

        return redirect()->route('novedades.index');
    }

    public function render()
    {

        $programa = Programas::all();
        $cat = Cat::all();
        $novedad = TipoNovedad::all();

        return view('livewire.editar-novedad', [
            'programas' => $programa,
            'cats' => $cat,
            'novedades' => $novedad
        ]);
    }
}
