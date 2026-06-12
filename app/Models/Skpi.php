<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skpi extends Model
{
    protected $table = 'skpi';

    protected $fillable = [
        'student_id',
        'file_sertifikat',
    ];
}