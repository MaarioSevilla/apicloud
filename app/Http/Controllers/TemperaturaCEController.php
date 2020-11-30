<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemperaturaCE;
use Validator;

class TemperaturaCEController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  string  $idMatricula
     * @return \Illuminate\Http\Response
     */
    public function showtempthreebyid($idMatricula)
    {
        $temperatura = TemperaturaCE::select("temperaturaCE.*")
            ->where("temperaturaCE.idMatricula", $idMatricula)
            ->orderBy('temperaturaCE.fecha', 'desc')
            ->take(3)->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $temperatura,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  varchar  $idMatricula
     * @return \Illuminate\Http\Response
     */
    public function showtempbyid($idMatricula)
    {
        $temperatura = TemperaturaCE::select("temperaturaCE.*")
            ->where("temperaturaCE.idMatricula", $idMatricula)
            ->orderBy('temperaturaCE.fecha', 'desc')
            ->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $temperatura,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $temperatura = TemperaturaCE::select("temperaturaCE.*")->get()->toArray();

        return response()->json($temperatura);
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
            'idMatricula' => 'required|max:10',
            'fecha' => 'required|date_format:Y-m-d H:i:s',
            'temperatura' => 'required|numeric|between:30,40.0',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }
        try {
            TemperaturaCE::create($input);
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
     * @param  bigint  $idSgtoTemp
     * @return \Illuminate\Http\Response
     */
    public function show($idSgtoTemp)
    {
        $temperatura = TemperaturaCE::select("temperaturaCE.*")
            ->where("temperaturaCE.idSgtoTemp", $idSgtoTemp)
            ->first();
        return response()->json([
            "ok" => true,
            "data" => $temperatura,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bigint  $idSgtoTemp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idSgtoTemp)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'idMatricula' => 'required|max:10',
            'fecha' => 'required|date_format:Y-m-d H:i:s',
            'temperatura' => 'required|max:4',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }
        try {
            $temperatura = TemperaturaCE::find($idSgtoTemp);
            if ($temperatura == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $temperatura->update($input);
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
     * @param  bigint  $idSgtoTemp
     * @return \Illuminate\Http\Response
     */
    public function destroy($idSgtoTemp)
    {
        try {
            $temperatura = TemperaturaCE::find($idSgtoTemp);
            if ($temperatura == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $temperatura->delete([
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
