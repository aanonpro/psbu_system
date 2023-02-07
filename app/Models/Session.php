<?php

namespace App\Models;

use App\Models\Shift;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Session extends Model
{
    use HasFactory;
    protected $table='sessions';
    protected $fillable =[
        'shift_id','name','khmer','start_date','end_date','status','trash','created_by','updated_by'
    ];
    public function shift(){
        return $this->belongsTo(Shift::class, 'shift_id', 'id');
    }
}
