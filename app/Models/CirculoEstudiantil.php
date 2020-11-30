<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CirculoEstudiantil extends Model
{
    public $table = "circuloEstudiantil";

    protected $fillable = [
        'idGrupo',
        'matriculaID'
    ];

    public $timestamps = false;
}
