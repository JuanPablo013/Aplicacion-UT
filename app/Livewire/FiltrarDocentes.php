<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Divipola;

class FiltrarDocentes extends Component
{

    public $termino;
    public $identificacion;
    public $ciudad;
    public $clasi_pregrado;

    public function leerDatosFormulario()
    {
        $this->dispatch('terminosBusqueda', $this->termino, $this->identificacion, $this->ciudad, $this->clasi_pregrado);
    }

    public function render()
    {

        $divipola = $divipola = Divipola::all();

        return view('livewire.filtrar-docentes', [
            'divipola_' => $divipola
        ]);
    }
}
