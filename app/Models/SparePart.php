<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SparePart extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['eliminado_en'];
    protected $table = 'repuestos';
    protected $fillable = ['foto_de_repuesto','nombre','precio','descripción','frecuencia_de_limpieza','frecuencia_de_lubricación','frecuencia_de_ajuste','frecuencia_de_revisión','frecuencia_de_cambio','frecuencia_de_solicitud'];
    public function assginSpares()
    {
        return $this->hasMany(AssginSpare::class, 'repuesto_id');
    }
}
