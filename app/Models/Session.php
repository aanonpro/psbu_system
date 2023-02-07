<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $table='sessions';
    protected $fillable =[
        'shift_id','name','khmer','start_date','end_date','status','trash','created_by','updated_by'
    ];
}
