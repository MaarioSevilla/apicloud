<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeguimientoFamiliar;
use Validator;

class SeguimientoFamiliarController extends Controller
{

    //tiene que mostrar tres pero que sean relacionados con la matricula
    public function showthree($matricula)
    {
        $seguimientofamiliar = SeguimientoFamiliar::select('familiares.idFamiliar','familiares.parentesco','familiares.nombreF','familiares.apellidoF','familiares.apellidoFII','seguimientoFamiliar.idSgtoF','seguimientoFamiliar.sintomaF','seguimientoFamiliar.gravedadF','seguimientoFamiliar.fechaHoraF','seguimientoFamiliar.notaF')
            ->join('familiares','seguimientoFamiliar.idsFamiliar', '=', 'familiares.idFamiliar')
            ->join('users','users.matricula', '=', 'familiares.idFMatricula')
            ->where("users.matricula", $matricula)
            ->orderBy('fechaHoraF', 'desc')
            ->take(4)->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $seguimientofamiliar,
        ]);
    }

    //tiene que mostrar tres pero que sean relacionados con la matricula
    public function showSgtoFamily($matricula)
    {
        $seguimientofamiliar = SeguimientoFamiliar::select('familiares.idFamiliar','familiares.parentesco','familiares.nombreF','familiares.apellidoF','familiares.apellidoFII','seguimientoFamiliar.idSgtoF','seguimientoFamiliar.idsFamiliar','seguimientoFamiliar.sintomaF','seguimientoFamiliar.gravedadF','seguimientoFamiliar.fechaHoraF','seguimientoFamiliar.notaF')
            ->join('familiares','seguimientoFamiliar.idsFamiliar', '=', 'familiares.idFamiliar')
            ->join('users','users.matricula', '=', 'familiares.idFMatricula')
            ->where("users.matricula", $matricula)
            ->orderBy('fechaHoraF', 'desc')
            ->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $seguimientofamiliar,
        ]);
    }

    public function index()
    {

        $seguimientofamiliar = SeguimientoFamiliar::select("seguimientoFamiliar.*")->get()->toArray();

        return response()->json($seguimientofamiliar);
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
            'idsFamiliar' => 'required',
            'sintomaF' => 'required|max:63',
            'gravedadF' => 'required',
            'fechaHoraF' => 'required|date_format:Y-m-d H:i:s',
            'notaF' => 'max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }
        try {
            SeguimientoFamiliar::create($input);
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
     * @param  int  $idSgtoF
     * @return \Illuminate\Http\Response
     */
    public function show($idSgtoF)
    {
        $seguimientofamiliar = SeguimientoFamiliar::select("seguimientoFamiliar.*")
            ->where("seguimientoFamiliar.idSgtoF", $idSgtoF)
            ->first();
        return response()->json([
            "ok" => true,
            "data" => $seguimientofamiliar,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idSgtoF
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idSgtoF)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'idsFamiliar' => 'required',
            'sintomaF' => 'required|max:63',
            'gravedadF' => 'required',
            'fechaHoraF' => 'required|date_format:Y-m-d H:i:s',
            'notaF' => 'max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }
        try {
            $seguimientofamiliar = SeguimientoFamiliar::find($idSgtoF);
            if ($seguimientofamiliar == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $seguimientofamiliar->update($input);
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
     * @param  int  $idSgtoF
     * @return \Illuminate\Http\Response
     */
    public function destroy($idSgtoF)
    {
        try {
            $seguimientofamiliar = SeguimientoFamiliar::find($idSgtoF);
            if ($seguimientofamiliar == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $seguimientofamiliar->delete([
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
