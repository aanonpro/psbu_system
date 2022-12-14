<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class faculty extends Model
{
    use HasFactory;

    protected $table = 'faculties';
    protected $fillable= [
        'name','khmer','status','trash','created_by','updated_by'
    ];
}
