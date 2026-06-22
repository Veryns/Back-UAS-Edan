<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skpi extends Model
{
    protected $table = 'skpi';

    protected $fillable = [
        'student_id',
        'kategori',
        'kegiatan',
        'tingkat',
        'klasifikasi',
        'periode_mulai',
        'periode_selesai',
        'file_sertifikat',
    ];
}