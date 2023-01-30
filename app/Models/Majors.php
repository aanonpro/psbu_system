<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Majors extends Model
{
    use HasFactory;
    protected $table = 'majors';
    protected $fillable = [
        'department_id','code','name','name_latin','status','trash','created_by','updated_by'
    ];

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

}
