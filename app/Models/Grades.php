<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{
    protected $table = 'grades';
    protected $fillable = ['student_id','matkul_id','type','grade'];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }
}