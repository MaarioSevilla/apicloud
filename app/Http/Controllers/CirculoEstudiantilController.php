<?php

namespace App\Http\Controllers;

use App\Models\CirculoEstudiantil;
use Illuminate\Http\Request;
use Validator;

class CirculoEstudiantilController extends Controller
{
    /**
     * Display the specified resource.
     * Para mostrar el circulo estudiantil al que pertenece una matricula
     * @param  int  $matriculaID
     * @return \Illuminate\Http\Response
     */
    public function cebyid($matriculaID)
    {
        $circulo = CirculoEstudiantil::select("circuloEstudiantil.*")
            ->where("circuloEstudiantil.matriculaID", $matriculaID)
            ->orderBy('circuloEstudiantil.idGrupo', 'ASC')
            ->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $circulo,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $circulo = CirculoEstudiantil::select("circuloEstudiantil.*")->get()->toArray();

        return response()->json($circulo);
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
            'idGrupo' => 'required|max:14',
            'matriculaID' => 'required|max:10',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }
        try {
            CirculoEstudiantil::create($input);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $circulo = CirculoEstudiantil::select("circuloEstudiantil.*")
            ->where("circuloEstudiantil.id", $id)
            ->first();
        return response()->json([
            "ok" => true,
            "data" => $circulo,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'idGrupo' => 'required|max:14',
            'matriculaID' => 'required|max:10',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }
        try {
            $circulo = CirculoEstudiantil::find($id);
            if ($circulo == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $circulo->update($input);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $circulo = CirculoEstudiantil::find($id);
            if ($circulo == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $circulo->delete([
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
