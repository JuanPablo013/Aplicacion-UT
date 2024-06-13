<?php

namespace App\Models;

use App\Models\Docente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Divipola extends Model
{
    use HasFactory;

    protected $table = 'divipola';

    public function docentes()
    {
        return $this->hasMany(Docente::class);
    }

}
