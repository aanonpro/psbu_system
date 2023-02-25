<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'stu_id','stu_name','stu_name_latin','stu_gender',
        'stu_dob','stu_address','stu_phone','stu_email',
        'degrees_id','shift_id','batch_id','status','trash',
        'created_by','updated_by'
    ];
}
