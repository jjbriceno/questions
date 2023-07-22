<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['categories' => Category::all()]);
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
            'category_number'   => ['required'],
            'name'              => ['required'],
            'level'             => ['required'],
        ]);

        $category = Category::create(
            [
                'category_number'   => $request->category_number,
                'name'              => $request->name,
                'level'             => $request->level,
            ]
        );

        return response()->json(['category' => $category], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return response()->json(['category' => $category], Response::HTTP_OK);
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
     * @param  App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'category_number'   => ['required'],
            'name'              => ['required'],
            'level'             => ['required'],
        ]);

        $category = Category::create(
            [
                'id'                => $category->is
            ],
            [
                'category_number'   => $request->category_number,
                'name'              => $request->name,
                'level'             => $request->level,
            ]
        );

        return response()->json(['category' => $category], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Category $category
     * @return \Illuminate\Http\Response with the result of the request
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['category' => $category], Response::HTTP_OK);
    }
}
