<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; 

class Bill extends Model
{
    protected $fillable = ['student_id','semester','jenis','virtual_account','deadline','total_tagihan','status'];
    public function hitungDenda($tanggalBayar = null){
        if(!$this->deadline) return 0;

        $deadline = Carbon::parse($this->deadline)->startOfDay();
        $bayar = $tanggalBayar ? Carbon::parse($tanggalBayar)->startOfDay() : Carbon::today();

        if($bayar->lte($deadline)) return 0;

        $selisihHari = $deadline->diffInDays($bayar);
        $jumlahBulan = (int) ceil($selisihHari / 30);

        return $this->total_tagihan * 0.03 * $jumlahBulan;
    }
    public function totalDenganDenda($tanggalBayar = null){
        return $this->total_tagihan + $this->hitungDenda($tanggalBayar);
    }
    public function payments(){
        return $this->hasMany(Payment::class);
    }
    public function dispensations(){
    return $this->hasMany(Dispensation::class);
    }
}
