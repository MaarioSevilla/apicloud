<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeguimientoFamiliar extends Model
{
    public $table = "seguimientoFamiliar";

    protected $primaryKey = 'idSgtoF';

    protected $fillable = [
        'idsFamiliar',
        'sintomaF',
        'gravedadF',
        'fechaHoraF',
        'notaF'
    ];

    public $timestamps = false;
}
