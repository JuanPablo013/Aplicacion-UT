<?php

namespace App\Models;

use App\Models\Docente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clasificacion extends Model
{
    use HasFactory;

    protected $table = 'clasificacion';

    public function docentes()
    {
        return $this->hasMany(Docente::class);
    }

}
