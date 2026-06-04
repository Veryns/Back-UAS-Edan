<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Grade;


class IPKController extends Controller
{
    public function show(Student $student)
    {
        $grades = Grade::where('student_id', $student->id)->get();

        $uts = $grades->where('type', 'UTS')->avg('score') ?? 0;
        $uas = $grades->where('type', 'UAS')->avg('score') ?? 0;
        $tugas = $grades->where('type', 'TUGAS')->avg('score') ?? 0;

        $finalScore = ($uts * 0.3) + ($uas * 0.4) + ($tugas * 0.3);

        if ($finalScore >= 85) {
            $grade = 'A';
            $ipk = 4.0;
        } elseif ($finalScore >= 80) {
            $grade = 'A-';
            $ipk = 3.7;
        } elseif ($finalScore >= 75) {
            $grade = 'B+';
            $ipk = 3.3;
        } elseif ($finalScore >= 70) {
            $grade = 'B';
            $ipk = 3.0;
        } elseif ($finalScore >= 65) {
            $grade = 'B-';
            $ipk = 2.7;
        } elseif ($finalScore >= 60) {
            $grade = 'C+';
            $ipk = 2.3;
        } elseif ($finalScore >= 55) {
            $grade = 'C';
            $ipk = 2.0;
        } elseif ($finalScore >= 50) {
            $grade = 'D';
            $ipk = 1.0;
        } else {
            $grade = 'E';
            $ipk = 0.0;
        }

        return response()->json([
            'student_id' => $student->id,
            'student_name' => $student->name,
            'final_score' => round($finalScore, 2),
            'grade' => $grade,
            'ipk' => $ipk
        ]);
    }
}