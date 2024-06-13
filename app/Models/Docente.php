<?php

namespace App\Models;

use App\Models\User;
use App\Models\Novedad;
use App\Models\Divipola;
use App\Models\Estudios;
use App\Models\Clasificacion;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Docente extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'docen_documento',
        'docen_lugarexpdoc',
        'docen_nombre',
        'docen_lugarresidencia',
        'docen_telefono',
        'docen_correoinst',
        'docen_correopersonal',
        'docen_tipo',
        'docen_clasificacionpregrado',
        'docen_clasificacionpregradoespecial',
        'docen_actaclasificacionpregrado',
        'docen_fechaclasificacion',
        'docen_clasificacionposgrado',
        'docen_perfilcompleto',
        'user_id'
    ];

    public function estudios()
    {
        return $this->hasMany(Estudios::class, 'id_docen');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clasificacion()
    {
        return $this->belongsTo(Clasificacion::class, 'docen_clasificacionpregrado');
    }

    public function lugarResidencia()
    {
        return $this->belongsTo(Divipola::class, 'docen_lugarresidencia');
    }

    public function lugarExpedicion()
    {
        return $this->belongsTo(Divipola::class, 'docen_lugarexpdoc');
    }

    public function novedad()
    {
        return $this->hasMany(Novedad::class, 'novedad_docente');
    }

    public function tipoDocente()
    {
        return $this->belongsTo(TipoDocente::class, 'docen_tipo');
    }
    
}
