<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispensation extends Model
{
    protected $fillable = ['student_id','bill_id','reason','status','extension_days'];
    public function bill(){
        return $this->belongsTo(Bill::class);
    }
}
