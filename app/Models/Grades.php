<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{
    protected $table = 'grades';

    protected $fillable = ['grade_id','student_id','type','score'];
}