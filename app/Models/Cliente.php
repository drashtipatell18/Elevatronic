<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Province;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['eliminado_en'];
    protected $table = 'clientes';
    protected $fillable = ['nombre','tipo_de_cliente','ruc','país','provincia','dirección','teléfono','teléfono_móvil','correo_electrónico','nombre_del_contacto','posición'];
    public function province() {
        return $this->belongsTo(Province::class, 'provincia'); // Adjust 'provincia_id' to your actual foreign key
    }
}
