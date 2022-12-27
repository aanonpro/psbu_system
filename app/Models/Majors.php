<?php

namespace App\Models;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Majors extends Model
{
    use HasFactory;
    protected $table = 'majors';
    protected $fillable = [
        'faculty_id','code','name','name_latin','status','trash','created_by','updated_by'
    ];

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }

}
