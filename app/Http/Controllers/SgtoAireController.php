<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SgtoAire;
use Validator;

class SgtoAireController extends Controller
{

    public function index()
    {
        $sgtoaire = SgtoAire::select("sgtoAire.*")->get()->toArray();

        return response()->json($sgtoaire);
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
            'iSAMatricula' => 'required|max:10',
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
            SgtoAire::create($input);
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
     * @param  int  $idSegtoAire
     * @return \Illuminate\Http\Response
     */
    public function show($idSegtoAire)
    {
        $sgtoaire = SgtoAire::select("sgtoAire.*")
            ->where("sgtoAire.idSegtoAire", $idSegtoAire)
            ->first();
        return response()->json([
            "ok" => true,
            "data" => $sgtoaire,
        ]);
    }

    public function showallbymat($iSAMatricula)
    {
        $sgtoaire = SgtoAire::select("sgtoAire.*")
            ->where("sgtoAire.iSAMatricula", $iSAMatricula)
            ->orderBy('fechaHora', 'desc')
            ->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $sgtoaire,
        ]);
    }

    public function onelastreg($iSAMatricula)
    {
        $sgtoaire = SgtoAire::select("sgtoAire.*")
            ->where("sgtoAire.iSAMatricula", $iSAMatricula)
            ->orderBy('fechaHora', 'desc')
            ->take(1)->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $sgtoaire,
        ]);
    }

    public function showthreebymat($iSAMatricula)
    {
        $iSAMatricula = SgtoAire::select("sgtoAire.*")
            ->where("sgtoAire.iSAMatricula", $iSAMatricula)
            ->orderBy('fechaHora', 'desc')
            ->take(3)->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $iSAMatricula,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idSegtoAire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idSegtoAire)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'iSAMatricula' => 'required|max:10',
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
            $sgtoaire = SgtoAire::find($idSegtoAire);
            if ($sgtoaire == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $sgtoaire->update($input);
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
     * @param  int  $idSegtoAire
     * @return \Illuminate\Http\Response
     */
    public function destroy($idSegtoAire)
    {
        try {
            $sgtoaire = SgtoAire::find($idSegtoAire);
            if ($sgtoaire == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $sgtoaire->delete([
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
