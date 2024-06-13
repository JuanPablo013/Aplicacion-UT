<?php

namespace App\Livewire;

use App\Models\Docente;
use Livewire\Component;
use App\Models\Estudios;
use Livewire\Attributes\On;

class MostrarDocente extends Component
{

    public $docente;

    #[On('eliminarEstudio')]

    public function eliminarEstudio(Estudios $estudio)
    {
        $this->authorize('delete', $estudio);
        $estudio->delete();
        return redirect(request()->header('Referer'));
    }

    public function mount(Docente $docente)
    {
        $this->docente = $docente->load('estudios');
    }

    public function render()
    {
        return view('livewire.mostrar-docente');
    }
}
