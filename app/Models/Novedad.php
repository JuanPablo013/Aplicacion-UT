<?php

namespace App\Models;

use App\Models\Cat;
use App\Models\Docente;
use App\Models\Programas;
use App\Models\TipoNovedad;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Novedad extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'novedades';

    protected $fillable = [
        'novedad_tipo',
        'novedad_codigoprograma',
        'novedad_docente',
        'novedad_codigocat',
        'novedad_semestre',
        'novedad_grupo',
        'novedad_codigoasignatura',
        'novedad_nombreasignatura',
        'novedad_horas',
        'novedad_horasfactor',
        'novedad_numeroestudiantes',
        'novedad_desplazamiento',
        'novedad_numerodesplazamiento',
        'novedad_observacion',
        'novedad_fechainicio',
        'novedad_fechafin',
        'novedad_soportes',
        'user_id'
    ];

    public function programa()
    {
        return $this->belongsTo(Programas::class, 'novedad_codigoprograma');
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class, 'novedad_docente');
    }

    public function cat()
    {
        return $this->belongsTo(Cat::class, 'novedad_codigocat');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sumarHorasPorTipoNovedad($docente_id, $novedad_nombre)
    {
        return $this->where('novedad_docente', $docente_id)
                    ->where('novedad_tipo', $novedad_nombre)
                    ->sum('novedad_horas');
    }

    public function sumarHorasPorTipoNovedadTG($docente_id, $trabajo_grado)
    {
        return $this->where('novedad_docente', $docente_id)
                    ->whereIn('novedad_tipo', $trabajo_grado)
                    ->sum('novedad_horas');
    }

    public function validarMaximoHoras($suma_horas_novedad, $horas, $novedad_nombre)
    {
        $tipo_novedad = TipoNovedad::where('novedad_nombre', $novedad_nombre)->first();
        
        if ($novedad_nombre && $horas + $suma_horas_novedad > $tipo_novedad->novedad_horassemestre) {
            return 'Ha sobrepasado el límite de horas permitidas por semestre.';
        }

        return null; 
    }

    public function validarEdicionMaximoHoras($novedad_horas_actual, $suma_horas_novedad, $horas, $novedad_nombre)
    {
        // $nuevo_valor = $suma_horas_novedad - $horas;
        $nuevo_valor = ($suma_horas_novedad - $novedad_horas_actual) + $horas;
        
        $tipo_novedad = TipoNovedad::where('novedad_nombre', $novedad_nombre)->first();
        
        // if ($novedad_nombre && $horas > $tipo_novedad->novedad_horassemestre) {
        //     return 'Ha sobrepasado el límite de horas permitidas por semestre.';
        if ($nuevo_valor > $tipo_novedad->novedad_horassemestre) {
            return 'Ha sobrepasado el límite de horas permitidas por semestre.';
        }

        return null; 
    }

    public function validarEdicionMaximoHorasTG($novedad_horas_actual, $suma_horas_novedad, $horas, $novedad_nombre)
    {
        $nuevo_valor = ($suma_horas_novedad - $novedad_horas_actual) + $horas;
        
        $tipo_novedad = TipoNovedad::where('novedad_nombre', $novedad_nombre)->first();
        
        if ($novedad_nombre && $nuevo_valor > $tipo_novedad->novedad_horassemestre) {
            return 'Ha sobrepasado el límite de horas permitidas por semestre.';
        }

        return null; 
    }

}
