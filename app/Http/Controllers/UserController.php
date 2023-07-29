<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['users' => User::all()]);
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
        $validator = Validator::make(
            $request->all(),
            [
                'firstName'         => ['required'],
                'lastName'          => ['required'],
                'dni'               => ['required', 'numeric', 'unique:users,dni'],
                'email'             => ['required', 'email', 'unique:users,email'],
            ],
            [
                'firstName.required'            => 'Tu nombre nombre(s) es requerido',
                'lastName.required'             => 'Tu apellido(s) es requerido',
                'dni.required'                  => 'Introduce tu cédula de identidad',
                'dni.unique'                    => 'Esta cédula ya ha sido registrada',
                'email.required'                => 'Introduce un correo electrónico válido.',
                'email.email'                   => 'Introduce un correo electrónico válido.',
                'email.unique'                  => 'Este correo electrónico ya ha sido registrado',
            ]
        );

        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors(), 'inputs' => $request->all()], 422);
        }

        $user = User::create(
            [
                'name'          => $request->firstName,
                'last_name'     => $request->lastName,
                'dni'           => $request->dni,
                'email'         => $request->email,
                'password'      => '123456'
            ]
        );

        return response()->json(['user' => $user], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['user' => User::find($id)], Response::HTTP_OK);
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
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'firstName'         => ['required'],
                'lastName'          => ['required'],
                'dni'               => ['required', 'numeric', 'unique:users,dni' . $user->id],
                'email'             => ['required', 'email', 'unique:users,email' . $user->id],
            ],
            [
                'firstName.required'            => 'Tu nombre nombre(s) es requerido',
                'lastName.required'             => 'Tu apellido(s) es requerido',
                'dni.required'                  => 'Introduce tu cédula de identidad',
                'dni.unique'                    => 'Esta cédula ya ha sido registrada',
                'email.required'                => 'Introduce un correo electrónico válido.',
                'email.email'                   => 'Introduce un correo electrónico válido.',
                'email.unique'                  => 'Este correo electrónico ya ha sido registrado',
            ]
        );

        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors(), 'inputs' => $request->all()], 422);
        }

        $user = User::updateOrCreate(
            [
                'id'            => $user->id
            ],
            [
                'name'          => $request->name,
                'last_name'     => $request->last_name,
                'dni'           => $request->dni,
                'email'         => $request->email,
            ]
        );

        return response()->json(['user' => $user], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['user' => $user], Response::HTTP_OK);
    }
}
