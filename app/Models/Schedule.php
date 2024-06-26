<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['eliminado_en'];
    protected $table = 'cronogramas';
    protected $fillable = ['ascensor','revisar','técnico','mantenimiento','hora_de_inicio','hora_de_finalización','estado'];
}
