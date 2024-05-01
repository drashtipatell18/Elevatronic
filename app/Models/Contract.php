<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory;

    use HasFactory, SoftDeletes;
    protected $dates = ['eliminado_en'];
    protected $table = 'contratos';
    protected $fillable = ['ascensor','fecha_de_propuesta','monto_de_propuesta','monto_de_contrato','fecha_de_inicio','fecha_de_fin','renovación','cada_cuantos_meses','observación','estado_cuenta_del_contrato','estado'];
}
