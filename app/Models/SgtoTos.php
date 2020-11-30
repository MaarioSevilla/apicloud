<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SgtoTos extends Model
{
    public $table = "sgtoTos";

    protected $primaryKey = 'idSegtoTos';

    protected $fillable = [
        'iSTMatricula',
        'gravedad',
        'fechaHora'
    ];

    public $timestamps = false;
}
