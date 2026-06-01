<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\PaymentScheme;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UangKuliahController extends Controller
{
    public function menu(){
        return view('uangkuliah.menu');
    }
    public function index(){
        $bills = Bill::with('payments')->get();
        $bills->each(function($bill){
            $bill->terlambat = $bill->hitungDenda(Carbon::today()->toDateString()) > 0;
        });
        return view('uangkuliah.uangkuliah', compact('bills'));
    }
    public function showScheme(){
        $scheme = PaymentScheme::where('student_id',auth()->id())->first();
        return view('uangkuliah.payment_scheme',compact('scheme'));
    }
    public function saveScheme(Request $request){
        $student = auth()->user();
        
        PaymentScheme::updateOrCreate(
            ['student_id' => $student->id],
            ['scheme_type' => $request->scheme]
        );

        Bill::where('status', 'Belum Lunas')->delete();

        $bppBase = 9000000;
        $sksBase = 8000000;

        if ($request->scheme == 'FULL') {
            // tagihan bpp full
            $this->createNewBill('BPP - Full Payment', $bppBase, 30);
            // tagihan sks full
            $this->createNewBill('SKS - Full Payment', $sksBase, 30);
        }

        if ($request->scheme == 'INSTALLMENT') {
            // perhitungan BPP termin
            $bppTotalTermin = $bppBase + ($bppBase * 0.025); // 9.000.000 + 2.5% = 9.225.000
            
            // BPP termin 1 (60%) - Deadline 30 hari
            $this->createNewBill('BPP - Termin 1', $bppTotalTermin * 0.60, 30);
            
            // BPP termin 2 (40%) - Deadline 60 hari
            $this->createNewBill('BPP - Termin 2', $bppTotalTermin * 0.40, 60);

            // perhitungan SKS termin
            $sksTotalTermin = $sksBase + ($sksBase * 0.025); // 8.000.000 + 2.5% = 8.200.000
            
            // SKS termin 1 (60%) - Deadline 30 hari
            $this->createNewBill('SKS - Termin 1', $sksTotalTermin * 0.60, 30);
            
            // SKS termin 2 (40%) - Deadline 60 hari
            $this->createNewBill('SKS - Termin 2', $sksTotalTermin * 0.40, 60);
        }
        return redirect('/uang-kuliah');
    }
    private function createNewBill($jenisTagihan, $total, $daysToDeadline) {
        Bill::create([
            'jenis' => $jenisTagihan,
            'virtual_account' => rand(10000000, 99999999),
            'deadline' => now()->addDays($daysToDeadline),
            'semester' => '2',
            'total_tagihan' => $total,
            'status' => 'Belum Lunas'
        ]);
    }
}
