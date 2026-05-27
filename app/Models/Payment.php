<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['bill_id','jumlah_bayar','tanggal_bayar','metode'];
    public function bill(){
        return $this->belongsTo(Bill::class);
    }
}
