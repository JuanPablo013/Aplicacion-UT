<?php

namespace App\Models;

use App\Models\Novedad;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Programas extends Model
{
    use HasFactory;

    public function novedad()
    {
        return $this->hasMany(Novedad::class);
    }
    
}
