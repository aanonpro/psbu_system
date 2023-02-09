<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table= 'teachers';
    protected $fillable = [
        'position_id','code','sex','dob','pob','nationlity','email','phone',
        'address','expired_date','noted','image',
        'name_en', 'name_kh','status','trash','created_by','updated_by'
    ];
}
