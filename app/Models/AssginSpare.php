<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssginSpare extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['eliminado_en'];
    protected $table = 'assgin_spares';
    protected $fillable = ['nombre_del_tipo_de_ascensor','repuesto_id'];

    public function sparePart()
    {
        return $this->belongsTo(SparePart::class, 'id');
    }
}
