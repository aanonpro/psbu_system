<?php

namespace App\Models;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    protected $table='departments';
    protected $fillable=[
        'faculty_id','name','khmer', 'description', 'status', 'created_by', 'updated_by',
    ];
    public function faculty(){
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }

}
