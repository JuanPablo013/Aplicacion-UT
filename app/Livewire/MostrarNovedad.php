<?php

namespace App\Livewire;

use App\Models\Novedad;
use Livewire\Component;

class MostrarNovedad extends Component
{

    public $novedad;

    public function mount(Novedad $novedad)
    {
        $this->novedad = $novedad;
    }

    public function render()
    {   
        return view('livewire.mostrar-novedad');
    }
}
