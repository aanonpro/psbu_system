<?php

namespace App\Models;

use App\Models\Shift;
use App\Models\Degree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function degree(){
        return $this->belongsTo(Degree::class,'degrees_id','id');
    }
    public function shift(){
        return $this->belongsTo(Shift::class);
    }
    public function user(){
        return $this->belongsTo(User::class, 'created_by','id');
    }
}
