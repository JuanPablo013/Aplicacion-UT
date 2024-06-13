<?php

namespace App\Livewire;

use App\Models\Novedad;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class PanelNovedades extends Component
{

    use WithPagination;

    // public $mes;
    public $semestre;

    #[On('terminosBusqueda')]

    public function buscar($semestre)
    {
        // $this->mes = $mes;
        $this->semestre = $semestre;
    }

    public function render()
    {
    $novedades = Novedad::query()
        // ->when($this->mes, function($query) {
        //     $query->whereMonth('novedad_fechainicio', $this->mes);
        // })
        ->when($this->semestre, function($query) {
            $year = now()->year;
            if ($this->semestre === '01') {
                $fechaInicio = now()->setYear($year)->month(2)->day(1)->toDateString(); 
                $fechaFin = now()->setYear($year)->month(7)->day(31)->toDateString();
                $query->whereBetween('novedad_fechainicio', [$fechaInicio, $fechaFin]);
            } elseif ($this->semestre === '02') {
                $fechaInicio = now()->setYear($year)->month(8)->day(1)->toDateString(); 
                $fechaFin = now()->setYear($year)->month(12)->day(31)->toDateString(); 
                $query->whereBetween('novedad_fechainicio', [$fechaInicio, $fechaFin]);
            }
        })
        ->paginate(5);

        return view('livewire.panel-novedades', [
            'novedades' => $novedades
        ]);
    }

}
