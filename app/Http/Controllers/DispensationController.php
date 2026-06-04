<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Dispensation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DispensationController extends Controller
{
    public function index(){
        $bills = Bill::where('student_id',auth()->id())->where('status','Belum Lunas')->get();
        $dispensations = Dispensation::where('student_id',auth()->id())->latest()->get();

        return view('uangkuliah.dispensasi',compact('bills', 'dispensations'));
    }

    public function store(Request $request){
        Dispensation::create([
            'student_id' => auth()->id(),
            'bill_id' => $request->bill_id,
            'reason' => $request->reason,
            'requested_days' => $request->requested_days,
            'status' => 'Pending'
        ]);
        return back();
    }

    public function adminIndex(){
        $dispensations = Dispensation::with('bill')->get();
        return view('admin.dispensasi',compact('dispensations'));
    }

    public function approve(Request $request, $id){
        $dispensation = Dispensation::findOrFail($id);
        $dispensation->update(['status' => 'Approved','extension_days' =>$request->extension_days]);
        $bill = $dispensation->bill;
        $bill->deadline =Carbon::parse($bill->deadline)->addDays($request->extension_days);
        $bill->save();

        return back();
    }

    public function reject($id){
        $dispensation = Dispensation::findOrFail($id);
        $dispensation->update(['status' => 'Rejected']);

        return back();
    }
}
