<?php

namespace App\Models;

use App\Models\Teacher;
use App\Models\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeacherDetail extends Model
{
    use HasFactory;
    protected $table = 'teacher_details';
    protected $fillable =[
        'teacher_id','position_id','teacher_code','sex','dob',
        'nationality','email','phone','address','expired_date',
        'noted','photo','status','trash','password','created_by','updated_by'
    ];

    public function teacher(){
        return $this->hasMany(Teacher::class, 'teacher_id', 'id');
    }

    public function position(){
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }
}
