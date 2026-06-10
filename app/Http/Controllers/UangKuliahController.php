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

    public function index(Request $request){
        $student = Student::where('student_id', $request->student_id)->firstOrFail();
        $bills = Bill::where('student_id', $student->id)->with('payments')->get();
        $bills->each(function($bill){
            $bill->terlambat = $bill->hitungDenda(Carbon::today()->toDateString()) > 0;
        });
        return view('uangkuliah.uangkuliah', compact('bills','student'));
    }

    public function showScheme(Request $request){
        $student = Student::where('student_id', $request->student_id)->firstOrFail();
        $scheme = PaymentScheme::where('student_id', $student->id)->first();
        return view('uangkuliah.payment_scheme', compact('scheme', 'student'));
    }

    public function saveScheme(Request $request){
        $student = Student::where('student_id', $request->student_id)->firstOrFail();

        PaymentScheme::updateOrCreate(
            ['student_id' => $student->id],
            ['scheme_type' => $request->scheme]
        );

        Bill::where('student_id', $student->id)->where('status', 'Belum Lunas')->delete();

        $bppBase = 9000000;
        $sksBase = 8000000;

        if ($request->scheme == 'FULL') {
            $this->createNewBill($student->id, 'BPP - Full Payment', $bppBase, 30);
            $this->createNewBill($student->id, 'SKS - Full Payment', $sksBase, 60);
        }

        if ($request->scheme == 'INSTALLMENT') {
            $bppTotalTermin = $bppBase + ($bppBase * 0.025);
            $this->createNewBill($student->id, 'BPP - Termin 1', $bppTotalTermin * 0.60, 30);
            $this->createNewBill($student->id, 'BPP - Termin 2', $bppTotalTermin * 0.40, 60);

            $sksTotalTermin = $sksBase + ($sksBase * 0.025);
            $this->createNewBill($student->id, 'SKS - Termin 1', $sksTotalTermin * 0.60, 90);
            $this->createNewBill($student->id, 'SKS - Termin 2', $sksTotalTermin * 0.40, 120);
        }

        return redirect('/uang-kuliah?student_id=' . $request->student_id);
    }

    private function createNewBill($studentId, $jenisTagihan, $total, $daysToDeadline) {
        $semester = 2;
        $virtualAccount = '18888' . $studentId . '0' . $semester;
        Bill::create([
            'student_id'      => $studentId,
            'jenis'           => $jenisTagihan,
            'virtual_account' => $virtualAccount,
            'deadline'        => now()->addDays($daysToDeadline),
            'semester'        => $semester,
            'total_tagihan'   => $total,
            'status'          => 'Belum Lunas'
        ]);
    }
}