<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SgtoAire extends Model
{
    public $table = "sgtoAire";

    protected $primaryKey = 'idSegtoAire';

    protected $fillable = [
        'iSAMatricula',
        'gravedad',
        'fechaHora'
    ];

    public $timestamps = false;
}
