<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /* Helper
    function buat bikin unique id 9 digit
    */ 
    private function generateStudentId(): int
    {
        $last = Student::orderByDesc('student_id')->value('student_id');
        $next = $last ? $last + 1 : 100_000_000;
 
        if ($next > 999_999_999) {
            throw new \RuntimeException('Maximum student_id reached.');
        }
 
        return $next;
    }
    /**
     * GET Students
     */
    public function index(): JsonResponse
    {
        return response()->json(Student::all());
    }

    /**
     * POST /students (pake auth)
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'address'      => 'nullable|string|max:500',
            'phone_number' => 'nullable|string|max:20',
        ]);
 
        $student = Student::create([
            'student_id'   => $this->generateStudentId(),
            'name'         => $request->name,
            'address'      => $request->address,
            'phone_number' => $request->phone_number,
        ]);
 
        return response()->json($student, 201);
    }

    /**
     * GET /students/{studentId}
     */
    public function show(int $studentId): JsonResponse
    {
        $student = Student::where('student_id', $studentId)->first();
 
        if (! $student) {
            return response()->json(['message' => 'Student does not exist.'], 404);
        }
 
        return response()->json($student);
    }

    /**
     * PUT /students/{studentId} cuman bisa update alamat sama phone number
     * 
     */
    public function update(Request $request, int $studentId): JsonResponse
    {
        $request->validate([
            'address'      => 'nullable|string|max:500',
            'phone_number' => 'nullable|string|max:20',
        ]);
 
        $student = Student::where('student_id', $studentId)->first();
 
        if (! $student) {
            return response()->json(['message' => 'Student not found.'], 404);
        }
 
        $student->update($request->only('address', 'phone_number'));
 
        return response()->json($student);
    }

    /**
     *  DELETE /students/{studentId} pake auth
     */
    public function destroy(int $studentId): JsonResponse
    {
        $student = Student::where('student_id', $studentId)->first();
 
        if (! $student) {
            return response()->json(['message' => 'Student not found.'], 404);
        }
 
        $student->delete();
 
        return response()->json(['message' => 'Student deleted successfully.']);
    }
}
