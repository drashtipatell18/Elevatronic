<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $fillable = ['image','username','name','email','phone','employee_id','password'];

    public function employee() {
        return $this->belongsTo(Employee::class, 'employee_id'); // Ensure 'employee_id' is the correct foreign key
    }

}
