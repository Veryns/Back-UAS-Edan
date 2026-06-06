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
            'nama_sertifikat' => 'required|string|max:255',
            'organisasi'      => 'required|string|max:255',
            'tahun'           => 'required|integer',
            'deskripsi'       => 'nullable|string|max:500',
            'file_sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file_sertifikat')) {
            $filePath = $request->file('file_sertifikat')->store('skpi', 'public');
        }

        Skpi::create([
            'student_id'      => $studentId,
            'nama_sertifikat' => $request->nama_sertifikat,
            'organisasi'      => $request->organisasi,
            'tahun'           => $request->tahun,
            'deskripsi'       => $request->deskripsi,
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
            'nama_sertifikat' => 'required|string|max:255',
            'organisasi'      => 'required|string|max:255',
            'tahun'           => 'required|integer',
            'deskripsi'       => 'nullable|string|max:500',
            'file_sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $skpi = Skpi::find($id);
        if (!$skpi) abort(404);

        if ($request->hasFile('file_sertifikat')) {
            if ($skpi->file_sertifikat) {
                Storage::disk('public')->delete($skpi->file_sertifikat);
            }
            $skpi->file_sertifikat = $request->file('file_sertifikat')->store('skpi', 'public');
        }

        $skpi->update($request->only(
            'nama_sertifikat', 'organisasi', 'tahun', 'deskripsi'
        ));

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
}