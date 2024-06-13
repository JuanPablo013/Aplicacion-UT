<?php

namespace App\Http\Controllers;

use App\Models\Novedad;
use Illuminate\Http\Request;
use App\Exports\NovedadExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{

    public function exportarExcelNovedad($semestre = null)
    {
        
        $query = Novedad::query();

        // Filtra por mes y semestre si se proporciona un mes o un semestre
        if ($semestre) {
            $fechaInicio = null;
            $fechaFin = null;
            $year = now()->year;

            if ($semestre === '01') {
                $fechaInicio = now()->setYear($year)->month(2)->day(1)->toDateString(); 
                $fechaFin = now()->setYear($year)->month(7)->day(31)->toDateString();
            } elseif ($semestre === '02') {
                $fechaInicio = now()->setYear($year)->month(8)->day(1)->toDateString(); 
                $fechaFin = now()->setYear($year)->month(12)->day(31)->toDateString();  
            }

            $query->whereBetween('novedad_fechainicio', [$fechaInicio, $fechaFin]);
        }

        $novedades = $query->get();
        
        return Excel::download(new NovedadExport($novedades), 'novedades.xlsx');
    }
}
