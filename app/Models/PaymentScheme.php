<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentScheme extends Model
{
    protected $fillable = ['student_id','scheme_type'];
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
