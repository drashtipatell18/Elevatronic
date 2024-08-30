<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Elevators;
use App\Models\ReviewType;
use App\Models\Month;

class MaintInReview extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['eliminado_en'];
    protected $table = 'mant_en_revisións';
    protected $fillable = ['tipo_de_revisión','ascensor','dirección','provincia','núm_certificado','supervisor_id','técnico','mes_programado','fecha_de_mantenimiento','hora_inicio','hora_fin','observaciónes','observaciónes_internas','solución','ascensor_id'];
   
    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id');
    }
    public function elevator()

    {
        return $this->belongsTo(Elevators::class, 'ascensor'); // Assuming 'ascensor_id' is the foreign key
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'técnico'); // Assuming 'técnico' is the foreign key
    }

    public function reviewtype()
    {
        return $this->belongsTo(ReviewType::class, 'tipo_de_revisión'); // Adjust the foreign key if necessary
    }
    public function month()
    {
        return $this->belongsTo(Month::class, 'mes_programado'); // Assuming 'mes_programado' is the foreign key
    }
    public function province()
    {
        return $this->belongsTo(Province::class, 'provincia'); // Assuming 'provincia' is the foreign key
    }
}
