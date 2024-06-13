<?php

namespace App\Livewire;

use Livewire\Component;

class FiltrarNovedades extends Component
{

    // public $mes;
    public $semestre;

    public function leerDatosFormulario()
    {
        $this->dispatch('terminosBusqueda', $this->semestre);
    }

    public function render()
    {
        return view('livewire.filtrar-novedades');
    }
}
