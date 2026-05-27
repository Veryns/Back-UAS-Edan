<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class UangKuliahController extends Controller
{
    public function index(){
        $bills = Bill::with('payments')->get();
        return view('uangkuliah', compact('bills'));
    }
}
