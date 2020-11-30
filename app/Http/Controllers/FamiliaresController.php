<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Familiares;
use Validator;
class FamiliaresController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $idFMatricula
     * @return \Illuminate\Http\Response
     */
    public function myfamily($idFMatricula)
    {
        $familiares = Familiares::select("familiares.*")
            ->where("familiares.idFMatricula", $idFMatricula)
            ->orderBy('nombreF', 'ASC')
            ->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $familiares,
        ]);
    }


    public function index()
    {
        $familiares = Familiares::select("familiares.*")->get()->toArray();
        return response()->json($familiares);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'parentesco' => 'required|max:63',
            'nombreF' => 'required|max:63',
            'apellidoF' => 'required|max:39',
            'apellidoFII' => 'max:39',
            'idFMatricula' => 'required|max:10',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }
        try {
            Familiares::create($input);
            return response()->json([
                "ok" => true,
                "mensaje" => "Se registro con exito",
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "ok" => false,
                "error" => $ex->getMessage(),
            ]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $idFamiliar
     * @return \Illuminate\Http\Response
     */
    public function show($idFamiliar)
    {
        $familiares = Familiares::select("familiares.*")
            ->where("familiares.idFamiliar", $idFamiliar)
            ->first();
        return response()->json([
            "ok" => true,
            "data" => $familiares,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idFamiliar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idFamiliar)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'parentesco' => 'required|max:63',
            'nombreF' => 'required|max:63',
            'apellidoF' => 'required|max:39',
            'apellidoFII' => 'max:39',
            'idFMatricula' => 'required|max:10',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }
        try {
            $familiares = Familiares::find($idFamiliar);
            if ($familiares == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $familiares->update($input);
            return response()->json([
                "ok" => true,
                "mensaje" => "Se modifico con exito",
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
     * @param  int  $idFamiliar
     * @return \Illuminate\Http\Response
     */
    public function destroy($idFamiliar)
    {
        try {
            $familiares = Familiares::find($idFamiliar);
            if ($familiares == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $familiares->delete([
            ]);
            return response()->json([
                "ok" => true,
                "mensaje" => "Se elimino con exito",
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "ok" => false,
                "error" => $ex->getMessage(),
            ]);
        }
    }
}
