<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $primaryKey = 'student_id';
    public $incrementing = false;

    protected $fillable = [
        'student_id', 'name', 'address', 'phone_number', 'program_studi', 'email', 'password'
    ];

    protected $hidden = ['password'];

    public function paymentScheme()
    {
        return $this->hasOne(PaymentScheme::class);
    }
}

