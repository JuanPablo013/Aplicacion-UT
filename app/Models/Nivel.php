<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;

    protected $table = 'nivel_academico';

    public function estudios()
    {
        return $this->hasMany(Estudios::class);
    }
    
}
