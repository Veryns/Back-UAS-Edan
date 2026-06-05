<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Model
{
    protected $fillable = ['student_id', 'name', 'address', 'phone_number'];
    public function paymentScheme(){
        return $this->hasOne(PaymentScheme::class);
    }
}

