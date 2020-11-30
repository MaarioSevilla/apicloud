<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultadoCovidF extends Model
{
    public $table = "resultadoCovidF";

    protected $primaryKey = 'idCovF';

    protected $fillable = [
        'idFamiliarF',
        'resultadoCovidF',
        'fechaCE'
    ];

    public $timestamps = false;
}
