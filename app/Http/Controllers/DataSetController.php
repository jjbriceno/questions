<?php

namespace App\Http\Controllers;

use App\Models\DataSet;
use App\Models\Category;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Exports\DataSetExport;
use Maatwebsite\Excel\Facades\Excel;

class DataSetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_set = DataSet::whereHas(['category', 'question', 'user'])
        ->with(['category', 'question', 'user'])->get();

        return response()->json(['data_set' => $data_set]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'question_id'       => ['required'],
            'user_id'           => ['required'],
            'user_answers.*'       => ['required'],
        ]);

        $user_id        = User::find($request->user_id)->id ?? 1;
        foreach ($request->user_answers as $question_id => $user_answer) {
            $question       = Question::find($question_id + 1);
            $data_set       = DataSet::create(
            [
                'category_id'       => $question->category_id,
                'question_id'       => $question->id,
                'user_id'           => $user_id,
                'user_answer'       => $user_answer,
                'correct_answer'    => $question->answer,
                'output'            => $user_answer == $question->answer,
                ]
            );
        }

        return response()->json(['data_set' => $data_set], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data_set = DataSet::whereHas(['category', 'question', 'user'])
        ->with(['category', 'question', 'user'])->find($id);
        return response()->json(['data_set' => $data_set], Response::HTTP_OK);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\DataSet $data_set
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataSet $data_set)
    {
        $this->validate($request, [
            'question_id'       => ['required'],
            'user_id'           => ['required'],
            'user_answer'       => ['required'],
        ]);

        $question       = Question::find($request->question_id);
        $user_id        = User::find($request->user_id)->id ?? 1;
        $data_set       = DataSet::updateOrCreate(
            [
                'id'                => $data_set->id,
            ],
            [
                'category_id'       => $question->category_id,
                'question_id'       => $question->id,
                'user_id'           => $user_id,
                'user_answer'       => $request->user_answer,
                'correct_answer'    => $question->answer,
                'output'            => $request->user_answer == $question->answer,
            ]
        );

        return response()->json(['data_set' => $data_set], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\DataSet $data_set
     * @return \Illuminate\Http\Response with the result of the request
     */
    public function destroy(DataSet $data_set)
    {
        $data_set->delete();
        return response()->json(['data_set' => $data_set], Response::HTTP_OK);
    }

    /**
     * For export .csv files
     */
    public function export()
    {
        return Excel::download(new DataSetExport, 'DataSet.csv');
    }
}