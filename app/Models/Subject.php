<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subjects';
    protected $fillable =[
        'faculty_id','department_id','major_id','semester_id','academic_id','title_en','title_kh',
        'credit','noted','shortcut','status','trash','created_by','updated_by',
    ];
}
