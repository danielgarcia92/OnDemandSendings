<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class CSVExport implements FromView
{
    use Exportable;

    function __construct($data){
        $this->data = $data;
    }

    public function View(): View {

        return view('exports.exportCSV', [
            'data' => $this->data
        ]);
    }

}
