<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $fillable = [
        'nama',
        'kodematkul',
        'sks',
        'deskripsi',
        'nama_dosen',
        'nip_dosen',
        'email_dosen',
        'kodemsteam',
    ];
}
