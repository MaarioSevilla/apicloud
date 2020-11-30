<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultadoCovidE extends Model
{
    public $table = "resultadoCovidE";

    protected $primaryKey = 'idCov';

    protected $fillable = [
        'matriculai',
        'resultadoCovid',
        'fechaPositivoCE',
        'fechaNegativoCE'
    ];

    public $timestamps = false;
}
