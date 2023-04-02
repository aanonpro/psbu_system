<?php

namespace App\Models;

use App\Models\User;
use App\Models\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;
    protected $table= 'teachers';
    protected $fillable = [
        'position_id','code','sex','dob','pob','nationality','email','phone',
        'address','expired_date','noted','image',
        'name_en', 'name_kh','status','trash','created_by','updated_by'
    ];

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by','id');
    }
}
