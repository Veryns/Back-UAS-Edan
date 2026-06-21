<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Grades;
use Illuminate\Http\Request;

class GradesController extends Controller
{

/**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (!Auth::check()) {
            abort(403);
        }

        $request->validate([
            'student_id' => 'required|exists:students,student_id',
            'matkul_id' => 'required|exists:matkul,id',
            'type' => 'required|in:UTS,UAS,TUGAS',
            'grade' => 'required|numeric|min:0|max:100'
        ]);

        Grades::create([
            'student_id' => $request->student_id, // NIM
            'matkul_id' => $request->matkul_id,
            'type' => $request->type,
            'grade' => $request->grade
        ]);

        return redirect('/home/grades');
    }

    public function destroy($id)
    {
        if (!Auth::check()) {
            abort(403);
        }

        $grade = Grades::findOrFail($id);

        $grade->delete();

        return response()->json([
            'message' => 'Grade deleted successfully'
        ]);

        return redirect('/home/grades');
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
    $grade = Grades::findOrFail($grade_id);
    return view('grades.show', compact('grade'));
}

public function edit($grade_id)
{
    $grade = Grades::findOrFail($grade_id);
    return view('grades.edit', compact('grade'));
}

public function update(Request $request, $grade_id)
{
    $grade = Grades::findOrFail($grade_id);

    $grade->update([
        'student_id' => $request->student_id,
        'matkul_id' => $request->matkul_id,
        'grade' => $request->grade
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

public function studentGrades()
{
    $student = Auth::guard('student')->user();

    $grades = Grades::where(
        'student_id',
        $student->student_id
    )->get();

    return view(
        'grades.student_grades',
        compact('grades')
    );
}


}