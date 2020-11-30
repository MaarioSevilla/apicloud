<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SgtoSintomas extends Model
{
    public $table = "sgtoSintomas";

    protected $primaryKey = 'idSgtoSintomas';

    protected $fillable = [
        'iMatricula',
        'sintoma',
        'gravedad',
        'fechaHora'
    ];

    public $timestamps = false;
}
