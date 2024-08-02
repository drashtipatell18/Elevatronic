<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerType extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['eliminado_en'];
    protected $table = 'customer_types';
    protected $fillable = ['tipo_de_client'];
}
