<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImagePdfs extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'image_pdfs';
    protected $fillable = ['image','document', 'mant_en_revisións_id'];
}
