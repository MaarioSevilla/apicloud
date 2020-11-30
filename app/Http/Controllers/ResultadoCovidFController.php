<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResultadoCovidF;
use Validator;

class ResultadoCovidFController extends Controller
{

    public function myregisters($idFamiliarF)
    {
        $familiares = ResultadoCovidF::select("resultadoCovidF.*")
            ->where("resultadoCovidF.idFamiliarF", $idFamiliarF)
            ->orderBy('fechaCE', 'desc')
            ->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $familiares,
        ]);
    }

    public function index()
    {

        $resultadocovidf = ResultadoCovidF::select("resultadoCovidF.*")->get()->toArray();

        return response()->json($resultadocovidf);
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
            'idFamiliarF' => 'required',
            'resultadoCovidF' => 'required',
            'fechaCE' => 'required|date_format:Y-m-d H:i:s',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }
        try {
            ResultadoCovidF::create($input);
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
     * @param  int  $idCovF
     * @return \Illuminate\Http\Response
     */
    public function show($idCovF)
    {
        $resultadocovidf = ResultadoCovidF::select("resultadoCovidF.*")
            ->where("resultadoCovidF.idCovF", $idCovF)
            ->first();
        return response()->json([
            "ok" => true,
            "data" => $resultadocovidf,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idCovF
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idCovF)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'idFamiliarF' => 'required',
            'resultadoCovidF' => 'required',
            'fechaCE' => 'required|date_format:Y-m-d H:i:s',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }
        try {
            $resultadocovidf = ResultadoCovidF::find($idCovF);
            if ($resultadocovidf == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $resultadocovidf->update($input);
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
     * @param  int  $idCovF
     * @return \Illuminate\Http\Response
     */
    public function destroy($idCovF)
    {
        try {
            $resultadocovidf = ResultadoCovidF::find($idCovF);
            if ($resultadocovidf == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $resultadocovidf->delete([
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
