<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skpi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SkpiController extends Controller
{
    public function index()
    {
        $studentId = Auth::guard('student')->user()->student_id;
        $skpis = Skpi::where('student_id', $studentId)->get();
        return view('skpi.index', compact('skpis'));
    }

    public function create()
    {
        return view('skpi.create');
    }

    public function store(Request $request)
    {
        $studentId = Auth::guard('student')->user()->student_id;

        $request->validate([
            'kategori'        => 'required|string',
            'kegiatan'        => 'required|string',
            'tingkat'         => 'required|string',
            'klasifikasi'     => 'required|string',
            'periode_mulai'   => 'required|date',
            'periode_selesai' => 'required|date',
            'file_sertifikat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $filePath = $request->file('file_sertifikat')->store('skpi', 'public');

        Skpi::create([
            'student_id'      => $studentId,
            'kategori'        => $request->kategori,
            'kegiatan'        => $request->kegiatan,
            'tingkat'         => $request->tingkat,
            'klasifikasi'     => $request->klasifikasi,
            'periode_mulai'   => $request->periode_mulai,
            'periode_selesai' => $request->periode_selesai,
            'file_sertifikat' => $filePath,
        ]);

        return redirect()->route('skpi.index');
    }

    public function show(int $id)
    {
        $skpi = Skpi::find($id);
        if (!$skpi) abort(404);
        return view('skpi.show', compact('skpi'));
    }

    public function edit(int $id)
    {
        $skpi = Skpi::find($id);
        if (!$skpi) abort(404);
        return view('skpi.edit', compact('skpi'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'file_sertifikat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $skpi = Skpi::find($id);
        if (!$skpi) abort(404);

        if ($skpi->file_sertifikat) {
            Storage::disk('public')->delete($skpi->file_sertifikat);
        }
        $skpi->file_sertifikat = $request->file('file_sertifikat')->store('skpi', 'public');
        $skpi->save();

        return redirect()->route('skpi.index');
    }

    public function destroy(int $id)
    {
        $skpi = Skpi::find($id);
        if (!$skpi) abort(404);

        if ($skpi->file_sertifikat) {
            Storage::disk('public')->delete($skpi->file_sertifikat);
        }

        $skpi->delete();

        return redirect()->route('skpi.index');
    }
    public function adminIndex(Request $request)
    {
        $query = \App\Models\Student::whereHas('skpis');

        if ($request->filled('nim')) {
            $query->where('student_id', 'like', '%' . $request->nim . '%');
        }

        $students = $query->paginate(10)->withQueryString();

        return view('skpi.admin-index', compact('students'));
    }

    public function adminShow($studentId)
    {
        $student = \App\Models\Student::where('student_id', $studentId)->firstOrFail();
        $skpis = Skpi::where('student_id', $studentId)->get();
        return view('skpi.admin-show', compact('student', 'skpis'));
}
}