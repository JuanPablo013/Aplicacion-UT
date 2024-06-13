<?php

namespace App\Models;

use App\Models\Novedad;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cat extends Model
{
    use HasFactory;

    protected $table = 'cat';

    public function novedad()
    {
        return $this->hasMany(Novedad::class);
    }

}
