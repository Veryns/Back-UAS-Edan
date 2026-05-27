<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['semester','jenis','virtual_account','deadline','total_tagihan','status'];
    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
