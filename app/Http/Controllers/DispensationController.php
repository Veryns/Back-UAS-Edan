<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Dispensation;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DispensationController extends Controller
{
    public function index(Request $request){
        if(auth()->guard('student')->check()){
            $student = auth()->guard('student')->user();
        }else{
            $student = Student::where('student_id',$request->student_id)->firstOrFail();
        }
        $bills = Bill::where('student_id',$student->id)->where('status','Belum Lunas')->get();
        $dispensations = Dispensation::where('student_id',$student->id)->whereHas('bill')->latest()->get();

        return view('uangkuliah.dispensasi',compact('student','bills','dispensations'));
    }

    public function store(Request $request){

        if(!auth()->guard('student')->check()){
            abort(403);
        }

        $request->validate([
            'bill_id' => 'required|exists:bills,id',
            'extension_days' => 'required|integer|min:1',
            'reason' => 'required|string',
        ]);
        
        $student = auth()->guard('student')->user();

        Dispensation::create([
            'student_id' => $student->id,
            'bill_id' => $request->bill_id,
            'reason' => $request->reason,
            'extension_days' => $request->extension_days,
            'status' => 'Pending'
        ]);

        return back();
    }

    public function approve($id){
        if(auth()->guard('student')->check()){
            abort(403);
        }
        $dispensation = Dispensation::findOrFail($id);
        $dispensation->update(['status' => 'Approved']);

        $bill = $dispensation->bill;
        $bill->deadline =Carbon::parse($bill->deadline)->addDays($dispensation->extension_days);
        $bill->save();

        return back();
    }

    public function reject($id){
        if(auth()->guard('student')->check()){
            abort(403);
        }
        $dispensation = Dispensation::findOrFail($id);
        $dispensation->update(['status' => 'Rejected']);

        return back();
    }
}
