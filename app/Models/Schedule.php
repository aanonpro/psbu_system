<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table= 'schedules';
    protected $fillable =[
        'department_id','major_id','academic_id','semester_id','shift_id',
        'teacher_id','sessions_id','room_id','subject_id','name_en','name_kh',
        'batchelor','academic_year','status','trash','created_by','updated_by',
    ];
}
