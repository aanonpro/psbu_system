<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table= 'teachers';
    protected $fillable = [
        'teacher_name_en', 'teacher_name_kh','status','trash','created_by','updated_by'
    ];
}
