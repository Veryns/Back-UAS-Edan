<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /* Helper
    function buat bikin unique id 9 digit
    */ 
    private function generateStudentId(string $programStudi): int
    {
        $prefixMap = [
            'Sistem Informasi' => 825,
            'Teknik Informatika' => 535,
        ];

        if (! isset($prefixMap[$programStudi])) {
            throw new \InvalidArgumentException('Invalid program studi selection.');
        }

        $prefix = $prefixMap[$programStudi];
        $year = (int) date('y');
        $start = ($prefix * 100_000_000) + ($year * 1_000_000);
        $end = $start + 999_999;

        $last = Student::where('student_id', '>=', $start)
            ->where('student_id', '<=', $end)
            ->orderByDesc('student_id')
            ->value('student_id');

        $next = $last ? $last + 1 : $start;

        if ($next > $end) {
            throw new \RuntimeException('Maximum student_id reached for '.$programStudi.' in '.$year.'.');
        }

        return $next;
    }
    /**
     * GET Students
     */
    public function index(Request $request)
    {
        $students = Student::all();

        if ($request->wantsJson()) {
            return response()->json($students);
        }

        return view('students.index', ['students' => $students]);
    }

    /**
     * POST /students (pake auth)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'address'      => 'nullable|string|max:500',
            'phone_number' => 'nullable|string|max:20',
            'program_studi'=> 'required|string|in:Sistem Informasi,Teknik Informatika',
            'email'        => 'required|email|unique:students,email',
            'password'     => 'required|string|min:6',
        ]);

        $student = Student::create([
            'student_id'    => $this->generateStudentId($request->program_studi),
            'name'          => $request->name,
            'address'       => $request->address,
            'phone_number'  => $request->phone_number,
            'program_studi' => $request->program_studi,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
        ]);

        if ($request->wantsJson()) {
            return response()->json($student, 201);
        }

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    /**
     * GET /students/{studentId}
     */
    public function show(Request $request, $studentId)
    {
        $studentId = (int) $studentId;
        $student = Student::where('student_id', $studentId)->first();

        if (! $student) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Student does not exist.'], 404);
            }

            abort(404, 'Student does not exist.');
        }

        if ($request->wantsJson()) {
            return response()->json($student);
        }

        return view('students.show', ['student' => $student]);
    }

    /**
     * Show form bikin new student
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Show form tedit student
     */
    public function edit(Request $request, $studentId)
    {
        $studentId = (int) $studentId;
        $student = Student::where('student_id', $studentId)->first();

        if (! $student) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Student not found.'], 404);
            }

            abort(404, 'Student not found.');
        }

        if ($request->wantsJson()) {
            return response()->json($student);
        }

        return view('students.edit', ['student' => $student]);
    }

    /**
     * PUT /students/{studentId} cuman bisa update alamat sama phone number
     * 
     */
    public function update(Request $request, $studentId)
    {
        $studentId = (int) $studentId;
        $request->validate([
            'address'      => 'nullable|string|max:500',
            'phone_number' => 'nullable|string|max:20',
        ]);

        $student = Student::where('student_id', $studentId)->first();

        if (! $student) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Student not found.'], 404);
            }

            return redirect()->route('students.index')->with('error', 'Student not found.');
        }

        $student->update($request->only('address', 'phone_number'));

        if ($request->wantsJson()) {
            return response()->json($student);
        }

        return redirect()->route('students.index')->with('success', 'Data updated successfully.');
    }

    /**
     *  DELETE /students/{studentId} pake auth
     */
    public function destroy(Request $request, $studentId)
    {
        $studentId = (int) $studentId;
        $student = Student::where('student_id', $studentId)->first();
 
        if (! $student) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Student not found.'], 404);
            }

            return redirect()->route('students.index')->with('error', 'Student not found.');
        }
 
        $student->delete();
 
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Student deleted successfully.']);
        }

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
