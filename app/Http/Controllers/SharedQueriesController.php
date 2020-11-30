<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class SharedQueriesController extends Controller
{
    /**
     * Display the specified resource.
     *si funciona
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function PruebaEloquent()
    {
        $sgtoTos = User::join('circuloEstudiantil','matricula', '=', 'circuloEstudiantil.matriculaID')
            ->join('resultadoCovidE','matricula', '=', 'resultadoCovidE.matriculai')
            ->select('matricula','nombre','apellido','apellidoII','idGrupo','resultadoCovid')
            ->where('resultadoCovid','1')
            ->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $sgtoTos,
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function PruebaQueryBuilder()
    {
        $users = \DB::table('users')
            ->join('circuloEstudiantil', 'users.matricula', '=', 'circuloEstudiantil.matriculaID')
            ->join('resultadoCovidE', 'users.matricula', '=', 'resultadoCovidE.matriculai')
            ->select('matricula','nombre','apellido','apellidoII', 'idGrupo', 'resultadoCovid')
            ->get()->toArray();
        return response()->json([
            "ok" => true,
            "data" => $users,
        ]);
    }

    /**
     * para el registro de los 3 que se muestran, una consulta
     * en tos
     * en aire
     * y el primero de otros sintomas
     *
     */


    /**
     *
     * antes de eliminar un registro principal, eliminar todos los registros con las tablas que tienen alguna
     * relacion
     *
     */
}


