<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SgtoSintomas;
use Validator;

class SgtoSintomasController extends Controller
{

    /**
     *
     *
     *
     **/

    /**
     *
    Otros síntomas menos comunes son los siguientes:
     * Molestias y dolores
     * Dolor de garganta
     * Diarrea
     * Conjuntivitis
     * Dolor de cabeza
     * Pérdida del sentido del olfato o del gusto
     * Erupciones cutáneas o pérdida del color en los dedos de las manos o de los pies
    Los síntomas graves son los siguientes:
     * Dificultad para respirar o sensación de falta de aire
     * Dolor o presión en el pecho
     * Incapacidad para hablar o moverse
     **/

    //mostrar el ultimo registro para la pantalla principal
    public function onelastreg($iMatricula)
    {
        $sgtosintomas = SgtoSintomas::select("sgtoSintomas.*")
            ->where("sgtoSintomas.iMatricula", $iMatricula)
            ->orderBy('fechaHora', 'desc')
            ->take(1)->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $sgtosintomas,
        ]);
    }

    //show solo tres primer categoria
    public function showthreebymat($iMatricula,$sintoma)
    {
        if($sintoma=="1"){
            $sintomaReal="Cansancio";
        }else if($sintoma=="2"){
            $sintomaReal="Molestias y dolores";
        }else if($sintoma=="3"){
            $sintomaReal="Dolor de garganta";
        }else if($sintoma=="4"){
            $sintomaReal="Diarrea";
        }else if($sintoma=="5"){
            $sintomaReal="Conjuntivitis";
        }else if($sintoma=="6"){
            $sintomaReal="Dolor de cabeza";
        }else if($sintoma=="7"){
            $sintomaReal="Pérdida del sentido del olfato";
        }else if($sintoma=="8"){
            $sintomaReal="Erupciones cutáneas";
        }else if($sintoma=="9"){
            $sintomaReal="Dolor o presión en el pecho";
        }else if($sintoma=="10"){
            $sintomaReal="Incapacidad para hablar o moverse";
        }
        $sgtosintomas = SgtoSintomas::select("sgtoSintomas.*")
            ->where("sgtoSintomas.iMatricula", $iMatricula)
            ->where("sgtoSintomas.sintoma", $sintomaReal)
            ->orderBy('fechaHora', 'desc')
            ->take(3)->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $sgtosintomas,
        ]);
    }

    //mostrar todos los sintomas pertenecientes a la categoria uno
    public function showallbymat($iMatricula,$sintoma)
    {
        if($sintoma=="1"){
            $sintomaReal="Cansancio";
        }else if($sintoma=="2"){
            $sintomaReal="Molestias y dolores";
        }else if($sintoma=="3"){
            $sintomaReal="Dolor de garganta";
        }else if($sintoma=="4"){
            $sintomaReal="Diarrea";
        }else if($sintoma=="5"){
            $sintomaReal="Conjuntivitis";
        }else if($sintoma=="6"){
            $sintomaReal="Dolor de cabeza";
        }else if($sintoma=="7"){
            $sintomaReal="Pérdida del sentido del olfato";
        }else if($sintoma=="8"){
            $sintomaReal="Erupciones cutáneas";
        }else if($sintoma=="9"){
            $sintomaReal="Dolor o presión en el pecho";
        }else if($sintoma=="10"){
            $sintomaReal="Incapacidad para hablar o moverse";
        }
        $sgtosintomas = SgtoSintomas::select("sgtoSintomas.*")
            ->where("sgtoSintomas.iMatricula", $iMatricula)
            ->where("sgtoSintomas.sintoma", $sintomaReal)
            ->orderBy('fechaHora', 'desc')
            ->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $sgtosintomas,
        ]);
    }


    public function index()
    {
        $sgtosintomas = SgtoSintomas::select("sgtoSintomas.*")->get()->toArray();

        return response()->json($sgtosintomas);
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
            'iMatricula' => 'required|max:10',
            'sintoma' => 'required|max:63',
            'gravedad' => 'required',
            'fechaHora' => 'required|date_format:Y-m-d H:i:s',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }
        try {
            SgtoSintomas::create($input);
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
     * @param  int  $idSgtoSintomas
     * @return \Illuminate\Http\Response
     */
    public function show($idSgtoSintomas)
    {
        $sgtosintomas = SgtoSintomas::select("sgtoSintomas.*")
            ->where("sgtoSintomas.id", $idSgtoSintomas)
            ->first();
        return response()->json([
            "ok" => true,
            "data" => $sgtosintomas,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idSgtoSintomas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idSgtoSintomas)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'iMatricula' => 'required|max:10',
            'sintoma' => 'required|max:63',
            'gravedad' => 'required',
            'fechaHora' => 'required|date_format:Y-m-d H:i:s',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }
        try {
            $sgtosintomas = SgtoSintomas::find($idSgtoSintomas);
            if ($sgtosintomas == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $sgtosintomas->update($input);
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
     * @param  int  $idSgtoSintomas
     * @return \Illuminate\Http\Response
     */
    public function destroy($idSgtoSintomas)
    {
        try {
            $sgtosintomas = SgtoSintomas::find($idSgtoSintomas);
            if ($sgtosintomas == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $sgtosintomas->delete([
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
