<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SgtoTos;
use Validator;

class SgtoTosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showtosbyid($iSTMatricula)
    {
        $sgtoTos = SgtoTos::select("sgtoTos.*")
            ->where("sgtoTos.iSTMatricula", $iSTMatricula)
            ->orderBy('fechaHora', 'desc')
            ->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $sgtoTos,
        ]);
    }

    public function showlastmat($iSTMatricula)
    {
        $sgtoTos = SgtoTos::select("sgtoTos.*")
            ->where("sgtoTos.iSTMatricula", $iSTMatricula)
            ->orderBy('fechaHora', 'desc')
            ->take(1)->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $sgtoTos,
        ]);
    }

    public function showthreebymat($iSTMatricula)
    {
        $sgtoTos = SgtoTos::select("sgtoTos.*")
            ->where("sgtoTos.iSTMatricula", $iSTMatricula)
            ->orderBy('fechaHora', 'desc')
            ->take(3)->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $sgtoTos,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sgtoTos = SgtoTos::select("sgtoTos.*")->get()->toArray();

        return response()->json($sgtoTos);
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
            'iSTMatricula' => 'required|max:10',
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
            SgtoTos::create($input);
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
     * @param  bigint  $idSegtoTos
     * @return \Illuminate\Http\Response
     */
    public function show($idSegtoTos)
    {
        $sgtoTos = SgtoTos::select("sgtoTos.*")
            ->where("sgtoTos.idSegtoTos", $idSegtoTos)
            ->first();
        return response()->json([
            "ok" => true,
            "data" => $sgtoTos,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bigint  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idSegtoTos)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'iSTMatricula' => 'required|max:10',
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
            $sgtoTos = SgtoTos::find($idSegtoTos);
            if ($sgtoTos == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $sgtoTos->update($input);
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
     * @param  bigint  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idSegtoTos)
    {
        try {
            $sgtoTos = SgtoTos::find($idSegtoTos);
            if ($sgtoTos == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $sgtoTos->delete([
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
