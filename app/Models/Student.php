<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
      use HasFactory;
     public $timestamps = false;
     protected $primaryKey = 'student_id';
     protected $fillable = [
        'tenat_id',
        'first_name',
        'last_name',

        'grade',
    ];
}
