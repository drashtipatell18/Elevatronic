<?php

namespace App\Models\Elevatortypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Elevatortypes extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['eliminado_en'];
    protected $table = ['nombre_de_tipo_de_ascensor'];
}
?>