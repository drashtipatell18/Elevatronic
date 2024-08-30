<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Cliente;
use App\Models\Schedule;
use App\Models\Province;
use App\Models\Staff;
use App\Models\Elevatortypes\Elevatortypes;

class Elevators extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['eliminado_en'];
    protected $table = 'ascensores';
    protected $fillable = ['imagen', 'contrato', 'nombre', 'código', 'marca_id', 'client_id', 'fecha', 'garantizar', 'dirección', 'ubigeo', 'provincia', 'técnico_instalador', 'técnico_ajustador', 'tipo_de_ascensor', 'cantidad', 'quarters', 'npisos', 'ncontacto', 'teléfono', 'correo', 'descripcion1', 'descripcion2'];


    public function client()
    {
        return $this->belongsTo(Cliente::class, 'client_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'provincia'); // Add relation for provincia
    }

    public function tipoDeAscensor()
    {
        return $this->belongsTo(Elevatortypes::class, 'tipo_de_ascensor'); // Add relation for tipo_de_ascensor
    }
    public function tecnicoAjustador()
    {
        return $this->belongsTo(Staff::class, 'técnico_ajustador'); // Add relation for técnico_ajustador
    }

    public function tecnicoInstalador()
    {
        return $this->belongsTo(Staff::class, 'técnico_instalador'); // Add relation for técnico_instalador
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'elevator_id'); // Add relation for staff
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'ascensor', 'name');
    }
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id'); // Change to belongsTo
    }
}
