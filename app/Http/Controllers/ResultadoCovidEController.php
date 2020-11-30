<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResultadoCovidE;
use Validator;
class ResultadoCovidEController extends Controller
{

    public function showMe($matriculai)
    {
        $resultadocovide = ResultadoCovidE::select("resultadoCovidE.*")
            ->where("resultadoCovidE.matriculai", $matriculai)
            ->take(1)->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $resultadocovide,
        ]);
    }

    public function index()
    {
        $resultadocovide = ResultadoCovidE::select("resultadoCovidE.*")->get()->toArray();

        return response()->json($resultadocovide);
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
            'matriculai' => 'required|max:10',
            'resultadoCovid' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }
        try {
            ResultadoCovidE::create($input);
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
     * @param  int  $idCov
     * @return \Illuminate\Http\Response
     */
    public function show($idCov)
    {
        $resultadocovide = ResultadoCovidE::select("resultadoCovidE.*")
            ->where("resultadoCovidE.idCov", $idCov)
            ->first();
        return response()->json([
            "ok" => true,
            "data" => $resultadocovide,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idCov
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idCov)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'matriculai' => 'required|max:10',
            'resultadoCovid' => 'required',
            'fechaPositivoCE' => 'required|date_format:Y-m-d H:i:s',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }
        try {
            $resultadocovide = ResultadoCovidE::find($idCov);
            if ($resultadocovide == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $resultadocovide->update($input);
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
     * @param  int  $idCov
     * @return \Illuminate\Http\Response
     */
    public function destroy($idCov)
    {
        try {
            $resultadocovide = ResultadoCovidE::find($idCov);
            if ($resultadocovide == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $resultadocovide->delete([
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
