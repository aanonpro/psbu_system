<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subjects';
    protected $fillable =[
        'parent','title_en','title_kh','shortcut','score_parent','status','trash','created_by','updated_by',
    ];
}
