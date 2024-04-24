<?php

namespace App\Models\Elevatortypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Elevatortypes extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['eliminado_en'];
    protected $table = 'tipos_de_ascensors';
    protected $fillable = ['nombre_de_tipo_de_ascensor'];
}
