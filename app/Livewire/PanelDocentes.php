<?php

namespace App\Livewire;

use App\Models\Docente;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class PanelDocentes extends Component
{

    use WithPagination;

    public $termino;
    public $identificacion;
    public $ciudad;
    public $clasi_pregrado;

    #[On('terminosBusqueda')]

    public function buscar($termimo, $identificacion, $ciudad, $clasi_pregrado)
    {
        $this->termino = $termimo;
        $this->identificacion = $identificacion;
        $this->ciudad = $ciudad;
        $this->clasi_pregrado = $clasi_pregrado;
    }

    #[On('eliminarDocente')]

    public function eliminarDocente(Docente $docente)
    {
        $docente->delete();
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
    $docentes = Docente::query()
        ->when($this->termino, function($query) {
            $query->where(function($query) {
                $query->where('docen_nombre', 'LIKE', "%" . $this->termino . "%")
                    ->orWhere('docen_tipo', 'LIKE', "%" . $this->termino . "%")
                    ->orWhere('docen_perfilcompleto', 'LIKE', "%" . $this->termino . "%")
                    ->orWhere('docen_clasificacionpregradoespecial', 'LIKE', "%" . $this->termino . "%");
            });
        })
        ->when($this->identificacion, function($query) {
            $query->where('docen_documento', '=', $this->identificacion);
        })
        ->when($this->ciudad, function($query) {
            $query->where('docen_lugarresidencia', '=', $this->ciudad);
        })
        ->paginate(3);
        
        return view('livewire.panel-docentes', [
            'docentes' => $docentes
        ]);
    }
}