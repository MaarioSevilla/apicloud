<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familiares extends Model
{

    public $table = "familiares";

    protected $primaryKey = 'idFamiliar';

    protected $fillable = [
        'parentesco',
        'nombreF',
        'apellidoF',
        'apellidoFII',
        'idFMatricula'
    ];

    public $timestamps = false;
}
