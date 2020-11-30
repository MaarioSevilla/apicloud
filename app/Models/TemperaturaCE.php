<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemperaturaCE extends Model
{
    public $table = "temperaturaCE";

    protected $primaryKey = 'idSgtoTemp';

    protected $fillable = [
        'idMatricula',
        'fecha',
        'temperatura'
    ];

    public $timestamps = false;

}
