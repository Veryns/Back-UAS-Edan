<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /*
    function buat bikin unique id 9 digit
    */ 
    private function generateGradeId(): int
    {
        $last = Grade::orderByDesc('grade_id')->value('grade_id');
        $next = $last ? $last + 1 : 1;
 
        return $next;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

        $grade = Grade::create([
            'grade_id' => $this->generateGradeId(),
            'student_id' => $request->student_id,
            'type' => $request->type,
            'score' => $request->score
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $grade)
    {
        //
    }
}
