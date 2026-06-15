<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = 'matkul';
    protected $fillable = [
        'nama',
        'kodematkul',
        'sks',
        'deskripsi',
        'dosen',
        'kodemsteam',
    ];

    public function grades()
    {
        return $this->hasMany(Grades::class);
    }
}
