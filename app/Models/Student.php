<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['student_id', 'name', 'address', 'phone_number'];
    public function paymentScheme(){
        return $this->hasOne(PaymentScheme::class);
    }
}
