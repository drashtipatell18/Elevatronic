<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['eliminado_en'];
    protected $table = 'clientes';
    protected $fillable = ['nombre','tipo_de_cliente','ruc','país','provincia','dirección','teléfono','teléfono_móvil','correo_electrónico','nombre_del_contacto','posición'];
}
