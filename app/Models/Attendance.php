<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';
    protected $fillable = [
        'student_id','batch_id','semester_id','room_id','shift_id',
        'subject_id','date','status','total_attendance','created_by','updated_by',
    ];
}
