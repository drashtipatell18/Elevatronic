<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintInReview extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['eliminado_en'];
    protected $table = 'mant_en_revisións';
    protected $fillable = ['tipo_de_revisión','ascensor','dirección','provincia','supervisor','técnico','mes_programado','fecha_de_mantenimiento','hora_inicio','hora_fin','observaciónes','observaciónes_internas','solución'];

}
