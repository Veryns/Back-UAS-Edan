<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'semester',
        'total_tagihan',
        'status'
    ];
    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
