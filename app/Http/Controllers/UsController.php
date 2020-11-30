<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;

class UsController extends Controller
{

    public function myUser($matricula)
    {
        $user = User::select("users.*")
            ->where("users.matricula", $matricula)
            ->take(1)->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $user,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $matricula)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $validator = Validator::make($input, [
            'matricula' => 'required|max:10',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'nombre' => 'required|max:63',
            'apellido' => 'required|max:39',
            'apellidoII' => 'max:39',
            'tipoUsuario' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }
        try {
            $user = User::findOrFail($matricula);
            if ($user == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }

            $user->update($input);
            return response()->json([
                "ok" => true,
                "mensaje" => "Se modifico con exito" ,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "ok" => false,
                "error" => $ex->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
