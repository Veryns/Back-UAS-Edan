<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UangKuliahController extends Controller
{
    public function index(){
        $bills = Bill::with('payments')->get();
        $bills->each(function($bill){
            $bill->terlambat = $bill->hitungDenda(Carbon::today()->toDateString()) > 0;
        });
        return view('uangkuliah', compact('bills'));
    }
}
