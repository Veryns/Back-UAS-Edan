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

        return redirect('/home/grades');
    }

    public function destroy($grade_id)
    {
        $grade = Grades::where('grade_id', $grade_id)->first();

        if (!$grade) {
            return response()->json([
                'message' => 'Grade not found'
            ], 404);
        }

        $grade->delete();

        return response()->json([
            'message' => 'Grade deleted successfully'
        ]);
    }

    public function getUTS($studentId)
    {
        $grade = Grades::where('student_id', $studentId)
                        ->where('type', 'UTS')
                        ->first();

        if (!$grade) {
            return response()->json([
                'message' => 'UTS grade not found'
            ], 404);
        }

        return response()->json($grade);
    }

    public function getUAS($studentId)
    {
        $grade = Grades::where('student_id', $studentId)
                        ->where('type', 'UAS')
                        ->first();

        if (!$grade) {
            return response()->json([
                'message' => 'UAS grade not found'
            ], 404);
        }

        return response()->json($grade);
    }

    public function getTUGAS($studentId)
    {
        $grade = Grades::where('student_id', $studentId)
                        ->where('type', 'TUGAS')
                        ->first();

        if (!$grade) {
            return response()->json([
                'message' => 'TUGAS grade not found'
            ], 404);
        }

        return response()->json($grade);
    }

public function index()
{
    $grades = Grades::all();
    return view('grades.index', compact('grades'));
}

public function create()
{
    return view('grades.create');
}

public function show($grade_id)
{
    $grade = Grades::where('grade_id', $grade_id)->firstOrFail();
    return view('grades.show', compact('grade'));
}

public function edit($grade_id)
{
    $grade = Grades::where('grade_id', $grade_id)->firstOrFail();
    return view('grades.edit', compact('grade'));
}

public function update(Request $request, $grade_id)
{
    $grade = Grades::where('grade_id', $grade_id)->firstOrFail();

    $grade->update([
        'type' => $request->type,
        'score' => $request->score
    ]);

    return redirect('/home/grades');
}

public function getStudentGrades($studentId)
{
    $grades = Grades::where('student_id', $studentId)->get();

    if ($grades->isEmpty()) {
        return redirect()->route('grades.index')
                         ->with('error', 'Student grades not found');
    }

    return view('grades.student_grades', compact('grades', 'studentId'));
}


}