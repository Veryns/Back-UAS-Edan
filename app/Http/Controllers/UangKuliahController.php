<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\PaymentScheme;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UangKuliahController extends Controller
{
    public function menu(){
        return view('uangkuliah.menu');
    }
    public function index(){
        $student = Student::find(auth()->id());
        $bills = Bill::where('student_id', auth()->id())->with('payments')->get();
        $bills->each(function($bill){
            $bill->terlambat = $bill->hitungDenda(Carbon::today()->toDateString()) > 0;
        });
        return view('uangkuliah.uangkuliah', compact('bills','student'));
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

        Bill::where('student_id', auth()->id())->where('status', 'Belum Lunas')->delete();

        $bppBase = 9000000;
        $sksBase = 8000000;

        if ($request->scheme == 'FULL') {
            // tagihan bpp full
            $this->createNewBill($student->id,'BPP - Full Payment', $bppBase, 30);
            // tagihan sks full
            $this->createNewBill($student->id,'SKS - Full Payment', $sksBase, 30);
        }

        if ($request->scheme == 'INSTALLMENT') {
            // perhitungan BPP termin
            $bppTotalTermin = $bppBase + ($bppBase * 0.025); // 9.000.000 + 2.5% = 9.225.000
            
            // BPP termin 1 (60%) - Deadline 30 hari
            $this->createNewBill($student->id,'BPP - Termin 1', $bppTotalTermin * 0.60, 30);
            
            // BPP termin 2 (40%) - Deadline 60 hari
            $this->createNewBill($student->id,'BPP - Termin 2', $bppTotalTermin * 0.40, 60);

            // perhitungan SKS termin
            $sksTotalTermin = $sksBase + ($sksBase * 0.025); // 8.000.000 + 2.5% = 8.200.000
            
            // SKS termin 1 (60%) - Deadline 30 hari
            $this->createNewBill($student->id,'SKS - Termin 1', $sksTotalTermin * 0.60, 30);
            
            // SKS termin 2 (40%) - Deadline 60 hari
            $this->createNewBill($student->id,'SKS - Termin 2', $sksTotalTermin * 0.40, 60);
        }
        return redirect('/uang-kuliah');
    }
    private function createNewBill($studentId, $jenisTagihan, $total, $daysToDeadline) {
        $semester = 2;
        $virtualAccount = '18888' . $studentId .'0'. $semester;
        Bill::create([
            'student_id' => $studentId,
            'jenis' => $jenisTagihan,
            'virtual_account' => $virtualAccount,
            'deadline' => now()->addDays($daysToDeadline),
            'semester' => $semester,
            'total_tagihan' => $total,
            'status' => 'Belum Lunas'
        ]);
    }
}
