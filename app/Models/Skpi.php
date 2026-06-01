<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Skpi extends Model
{
    protected $table = 'skpi';
    protected $fillable = [
        'student_id',
        'nama_sertifikat',
        'organisasi',
        'tahun',
        'deskripsi',
        'file_sertifikat',
    ];
}