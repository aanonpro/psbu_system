<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    use HasFactory;
    protected $table='academics';
    protected $fillable =[
        'year','khmer','status','trash','created_by','updated_by'
    ];
}
