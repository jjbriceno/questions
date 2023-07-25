<?php

namespace App\Exports;

use App\Models\DataSet;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataSetExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data_sets = DataSet::all();

        return new Collection($data_sets);
    }

    public function headings() : array 
    {
        return [];
    }
}
