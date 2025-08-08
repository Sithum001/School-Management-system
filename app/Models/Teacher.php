<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
     public $timestamps = false;
     protected $primaryKey = 'teacher_id';
     protected $fillable = [
        'tenat_id',
        'first_name',
        'last_name',

        'suject',
    ];
}
