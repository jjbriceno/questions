<?php

namespace App\Exports;

use App\Models\DataSet;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataSetExport implements FromView //FromCollection, WithHeadings
{
    public function view() : View
    {
        return view('dataSet', [
            'dataSet' => DataSet::orderBy('user_id', 'ASC')->get()
        ]);
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return DataSet::select(
    //         'id',
    //         'category_id',
    //         'question_id',
    //         'user_id',
    //         'user_answer', 
    //         'correct_answer',
    //         'output'
    //     )->get();
    // }

    // public function headings() : array 
    // {
    //     return [
    //         'ID',
    //         'CategoryId',
    //         'QuestionId',
    //         'UserId',
    //         'UserAnswer', 
    //         'CorrectAnswer',
    //         'Output'
    //     ];
    // }
}
