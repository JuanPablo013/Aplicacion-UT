<?php

namespace App\Models;

use App\Models\Nivel;
use App\Models\Docente;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estudios extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id_docen',
        'id_nacad',
        'estud_titulo',
        'estud_universidad',
        // 'estud_fechagrado',
        'user_id'
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'id_nacad');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($estudios) {
            // Obtener el registro del docente
            $docente = Docente::find($estudios->id_docen);

            // Concatenar los nuevos valores al campo perfil_docente del docente
            $docente->docen_perfilcompleto .= ' ' . $estudios->estud_titulo . ' ' . $estudios->estud_universidad;

            // Guardar el registro del docente
            $docente->save();
        });

        static::updated(function ($estudios) {
            // Obtener el registro del docente
            $docente = Docente::find($estudios->id_docen);

            // Obtener los nuevos valores de estudios con el nombre de la universidad
            $nuevosEstudios = $docente->estudios()->pluck('estud_titulo', 'estud_universidad')->toArray();

            // Reemplazar el campo perfil_docente del docente con los nuevos valores de estudios
            $docente->docen_perfilcompleto = implode(' ', array_map(function ($titulo, $universidad) {
                return "$titulo $universidad";
            }, $nuevosEstudios, array_keys($nuevosEstudios)));

            // Guardar el registro del docente
            $docente->save();
        });

        static::deleted(function ($estudios) {
            // Obtener el registro del docente
            $docente = Docente::find($estudios->id_docen);
    
            // Eliminar el nombre del título y la universidad del campo perfil_docente del docente
            $docente->docen_perfilcompleto = str_replace($estudios->estud_titulo . ' ' . $estudios->estud_universidad, '', $docente->docen_perfilcompleto);
    
            // Guardar el registro del docente
            $docente->save();
        });
    }

}
