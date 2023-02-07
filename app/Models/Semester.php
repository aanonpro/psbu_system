<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $table='semesters';
    protected $fillable =[
        'name','khmer','status','trash','created_by','updated_by'
    ];
}
