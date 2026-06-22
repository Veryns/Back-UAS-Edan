<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('student.login');
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

    public function home()
    {
        $announcements = Announcement::latest()->get();
        return view('student.home', compact('announcements'));
    }

    public function announcements()
    {
        $announcements = Announcement::latest()->get();
        return view('student.announcements.index', compact('announcements'));
    }

    public function announcementShow(Announcement $announcement)
    {
        return view('student.announcements.show', compact('announcement'));
    }

    public function showCredential()
    {
        return view('student.credential');
    }

    public function checkCredential(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $student = Student::where('name', $request->name)->first();

        if (!$student) {
            return back()->withErrors(['name' => 'Nama tidak ditemukan.']);
        }

        return view('student.credential', [
            'student' => $student,
            'email'   => $student->email,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}