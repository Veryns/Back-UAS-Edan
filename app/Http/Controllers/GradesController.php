<?php

namespace App\Http\Controllers;

use App\Models\Grades;
use Illuminate\Http\Request;

class GradesController extends Controller
{
    /*
    function buat bikin unique id 9 digit
    */
    private function generateGradeId(): int
    {
        $last = Grades::orderByDesc('grade_id')->value('grade_id');

        $next = $last ? $last + 1 : 1;

        return $next;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'type' => 'required|in:UTS,UAS,TUGAS',
            'score' => 'required|numeric|min:0|max:100'
        ]);

        Grades::create([
            'grade_id' => $this->generateGradeId(),
            'student_id' => $request->student_id,
            'type' => $request->type,
            'score' => $request->score
        ]);

        return redirect('/grades');
    }
}