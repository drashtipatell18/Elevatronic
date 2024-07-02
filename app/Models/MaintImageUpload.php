<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintImageUpload extends Model
{
    use HasFactory;
    protected $table = "maint_in_review_images";
    protected $fillable = [
        'imagepath'
    ];

}
