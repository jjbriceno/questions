<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::whereHas('category')->with('category')->get();
        return response()->json(['questions' => $questions]);
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
            'category_id'       => ['required'],
            'question_name'     => ['required'],
            'answers_options'   => ['required'],
            'answer'            => ['required'],
            'unit'              => ['required'],
        ]);

        $category_id = Category::find($request->category_id)->id ?? 1;
        $question = Question::create(
            [
                'category_id'       => $category_id,
                'question_name'     => $request->question_name,
                'answers_options'   => json_encode([
                    $request->answers_options['option_1'],
                    $request->answers_options['option_2'],
                    $request->answers_options['option_3'],
                    $request->answers_options['option_4']
                ]),
                'answer'            => $request->answer,
                'unit'              => $request->unit,
            ]
        );

        return response()->json(['question' => $question], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::whereHas('category')->with('category')->find($id);
        return response()->json(['question' => $question], Response::HTTP_OK);
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
     * @param  App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $this->validate($request, [
            'category_id'       => ['required'],
            'question_name'     => ['required'],
            'answers_options'   => ['required'],
            'answer'            => ['required'],
            'unit'              => ['required'],
        ]);

        $category_id = Category::find($request->category_id)->id ?? 1;
        $question = Question::updateOrCreate(
            [
                'id'                => $question->id,
            ],
            [
                'category_id'       => $category_id,
                'question_name'     => $request->question_name,
                'answers_options'   => json_encode([
                    $request->answers_options['option_1'],
                    $request->answers_options['option_2'],
                    $request->answers_options['option_3'],
                    $request->answers_options['option_4']
                ]),
                'answer'            => $request->answer,
                'unit'              => $request->unit,
            ]
        );

        return response()->json(['question' => $question], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Question $question
     * @return \Illuminate\Http\Response with the result of the request
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json(['question' => $question], Response::HTTP_OK);
    }
}
