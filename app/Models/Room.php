<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable =[
        'number', 'name', 'khmer', 'floor', 'chair','table','property', 'status', 'trash', 'created_by', 'updated_by'
    ];
}
