<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Cliente;

class Elevators extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['eliminado_en'];
    protected $table = 'ascensores';
    protected $fillable = ['imagen','contrato','nombre','código','marca','cliente','fecha','garantizar','dirección','ubigeo','provincia','técnico_instalador','técnico_ajustador','tipo_de_ascensor','cantidad','quarters','npisos','ncontacto','teléfono','correo','descripcion1'];


    public function client()
    {
        return $this->belongsTo(Cliente::class, 'client_id');
    }
}
