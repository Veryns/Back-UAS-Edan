<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UangKuliahController extends Controller
{
    public function index(){
        $bills = Bill::with('payments')->get();
        return view('uangkuliah.index', compact('bills'));
    }
}
