<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class StudentAuth extends Authenticatable
{
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    public $incrementing = false;

    protected $fillable = [
        'student_id', 'name', 'address', 'phone_number', 'email', 'password'
    ];

    protected $hidden = ['password'];
}