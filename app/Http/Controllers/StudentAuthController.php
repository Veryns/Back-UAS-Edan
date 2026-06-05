<?php

namespace App\Http\Controllers;

use App\Models\StudentAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.student-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('student')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('student.home');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function showCredential()
    {
        return view('auth.student-credential');
    }

    public function checkCredential(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $student = StudentAuth::where('name', $request->name)->first();

        if (!$student) {
            return back()->withErrors(['name' => 'Nama tidak ditemukan.']);
        }

        return view('auth.student-credential', [
            'student' => $student,
            'email'   => $student->email,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('student.login.form');
    }
}