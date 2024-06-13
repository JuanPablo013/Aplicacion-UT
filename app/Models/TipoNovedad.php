<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoNovedad extends Model
{
    use HasFactory;

    protected $table = 'tipo_novedad';

    public function validarCursosPorHorasIguales($horas, $novedad)
    {
        $tipo_novedad = $this->where('novedad_nombre', $novedad)->first();

        if ($novedad && $horas != $tipo_novedad->novedad_horassemestre) {
            return 'Para el tipo de novedad ' . $tipo_novedad->novedad_nombre . ', las horas totales deben ser iguales a '. $tipo_novedad->novedad_horassemestre . '.';
        } 

        return null; 
    } 

    public function validarCursosPorHorasSemestre($horas, $novedad)
    {
        $tipo_novedad = $this->where('novedad_nombre', $novedad)->first();

        if ($novedad && $horas > $tipo_novedad->novedad_horassemestre) {
            return 'Para el tipo de novedad '. $tipo_novedad->novedad_nombre . ', las horas totales deben ser menores o iguales a '. $tipo_novedad->novedad_horassemestre . '.';
        } 

        return null; 
    }

    public function validarCursosPorHorasProceso($horas, $novedad)
    {
        $tipo_novedad = $this->where('novedad_nombre', $novedad)->first();

        if ($novedad && $horas > $tipo_novedad->novedad_horasproceso) {
            return 'Para el tipo de novedad '. $tipo_novedad->novedad_nombre . ', las horas totales deben ser menores o iguales a '. $tipo_novedad->novedad_horasproceso . '.';

        return null; // Retornar null si la validación falla
        }
    }

    public function validarHorasPorFactor($numero_estudiantes, $novedad)
    {
        $tipo_novedad = $this->where('novedad_nombre', $novedad)->first();

        $factor = 1.0;
        if ($numero_estudiantes === '1 a 10') {
            $factor = 1.11;
        } elseif ($numero_estudiantes === '11 a 35') {
            $factor = 1.13;
        } elseif ($numero_estudiantes === 'Mas de 35') {
            $factor = 1.15;
        } 

        $valor_calculado = $tipo_novedad->novedad_horassemestre * $factor;
        return $valor_calculado;
    }

    public function validarEdicionHorasPorFactor($numero_estudiantes, $horas)
    {

        $factor = 1.0;
        if ($numero_estudiantes === '1 a 10') {
            $factor = 1.11;
        } elseif ($numero_estudiantes === '11 a 35') {
            $factor = 1.13;
        } elseif ($numero_estudiantes === 'Mas de 35') {
            $factor = 1.15;
        }

        $valor_calculado = $horas * $factor;
        return $valor_calculado;
    }

    public function validarPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $nombre_tipodocente)
    {
        if ($tipo_docente === 1 && $horas_docente + $horas > $horas_semestre) {
            return 'No se puede ingresar la novedad porque supera las horas límite para el ' . $nombre_tipodocente . ' que son ' . $horas_semestre . ' horas.';
        } elseif ($tipo_docente === 2 && $horas_docente + $horas > $horas_semestre) {
            return 'No se puede ingresar la novedad porque supera las horas límite para el ' . $nombre_tipodocente . ' que son ' . $horas_semestre . ' horas.';
        } elseif ($tipo_docente === 3 && $horas_docente + $horas > $horas_semestre) {
            return 'No se puede ingresar la novedad porque supera las horas límite para el ' . $nombre_tipodocente . ' que son ' . $horas_semestre . ' horas.';
        } elseif ($tipo_docente === 4 && $horas_docente + $horas > $horas_semestre) {
            return 'No se puede ingresar la novedad porque supera las horas límite para el ' . $nombre_tipodocente . ' que son ' . $horas_semestre . ' horas.';
        }
        return null;
    }

    public function validarEdicionPorTipoDocente($tipo_docente, $horas_docente, $horas_semestre, $horas, $novedad_horas_actual, $nombre_tipodocente)
    {
        $nuevo_valor = $horas_docente - $novedad_horas_actual + $horas;
        // dd($novedad_horas_actual, $tipo_docente, $horas_docente, $horas_semestre, $horas, $nuevo_valor, $nombre_tipodocente);

        if ($tipo_docente === 1 && $nuevo_valor > $horas_semestre) {
            return 'No se puede ingresar la novedad porque supera las horas límite para el ' . $nombre_tipodocente . ' que son ' . $horas_semestre . ' horas.';
        } elseif ($tipo_docente === 2 && $nuevo_valor > $horas_semestre) {
            return 'No se puede ingresar la novedad porque supera las horas límite para el ' . $nombre_tipodocente . ' que son ' . $horas_semestre . ' horas.';
        } elseif ($tipo_docente === 3 && $nuevo_valor > $horas_semestre) {
            return 'No se puede ingresar la novedad porque supera las horas límite para el ' . $nombre_tipodocente . ' que son ' . $horas_semestre . ' horas.';
        } elseif ($tipo_docente === 4 && $nuevo_valor > $horas_semestre) {
            return 'No se puede ingresar la novedad porque supera las horas límite para el ' . $nombre_tipodocente . ' que son ' . $horas_semestre . ' horas.';
        }
        return null;
    }

}
