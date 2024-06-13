<?php

namespace App\Exports;

use App\Models\Novedad;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NovedadExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    protected $novedades;

    public function __construct($novedades)
    {
        $this->novedades = $novedades;
    }

    public function view(): View
    {
        return view('novedades.exportnovedades', [
            'novedades' => $this->novedades
        ]);
    }
}
