<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UangKuliahController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\SkpiController;
use App\Http\Controllers\IPKController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DispensationController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    if (Auth::guard('student')->check()) {
        return redirect()->route('student.home');
    }
    return view('welcome');
})->name('welcome');

use Illuminate\Support\Facades\DB;

Route::get('/vulnerable', function () {
    $name = request('name');
    $user = DB::select("SELECT * FROM users WHERE name = ?", [$name]);
    return $user;
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

//route untuk students
Route::resource('students', StudentController::class)->except(['store', 'update', 'destroy']);

Route::middleware('auth')->group(function () {
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::put('/students/{studentId}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{studentId}', [StudentController::class, 'destroy'])->name('students.destroy');
});

// route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// route buat home
Route::get('/home', [AuthController::class, 'home'])->name('home')->middleware('auth');

// Grades untuk admin
Route::middleware('auth')->group(function () {

    Route::resource('/home/grades', GradesController::class);

    Route::get('/grades/{studentId}',
        [GradesController::class, 'getStudentGrades']
    )->name('grades.show');
});


Route::prefix('uang-kuliah')->group(function () {
    Route::get('/', [UangKuliahController::class, 'index']);
    Route::get('/menu', [UangKuliahController::class, 'menu']);
    Route::get('/payment-scheme', [UangKuliahController::class, 'showScheme']);
    Route::post('/payment-scheme', [UangKuliahController::class, 'saveScheme']);
    Route::get('/dispensasi', [DispensationController::class, 'index']);
    Route::post('/dispensasi', [DispensationController::class, 'store']);
    Route::post('/dispensasi/{id}/approve', [DispensationController::class, 'approve']);
    Route::post('/dispensasi/{id}/reject', [DispensationController::class, 'reject']);
});

// route untuk matkul ga tau kenapa setelah say mencoba untuk memperbaiki error solusi nya adalah dengan menonaktifkan route ini
// Route::get('/matkul',[MatkulController::class, 'index']);
// Route::get('/matkul/{id}',[MatkulController::class, 'show']);
// Route::get('/matkul/create', [MatkulController::class, 'create']);
// Route::post('/matkul',[MatkulController::class, 'store']);
// Route::put('/matkul/{id}',[MatkulController::class, 'update']);
// Route::delete('/matkul{id}',[MatkulController::class, 'destroy']);
Route::resource('matkul', MatkulController::class);

// route untuk register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

// route untuk skpi
Route::resource('skpi', SkpiController::class);
Route::middleware('auth')->group(function () {
    Route::get('/admin/skpi', [SkpiController::class, 'adminIndex'])->name('admin.skpi.index');
    Route::get('/admin/skpi/{studentId}', [SkpiController::class, 'adminShow'])->name('admin.skpi.show');
});

//route w5
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

//route untuk IPK
Route::get('/students/{student}/ipk', [IPKController::class, 'show']);

//route untuk announcements
Route::middleware('auth')->group(function () {
    Route::resource('announcements', AnnouncementController::class);
});

// route untuk login mahasiswa
Route::get('/student/login', [StudentAuthController::class, 'showLoginForm'])->name('student.login.form');
Route::post('/student/login', [StudentAuthController::class, 'login'])->name('student.login');
Route::get('/student/credential', [StudentAuthController::class, 'showCredential'])->name('student.credential');
Route::post('/student/credential', [StudentAuthController::class, 'checkCredential']);
Route::post('/student/logout', [StudentAuthController::class, 'logout'])->name('student.logout');

// route untuk student pages
Route::middleware('auth.student')->group(function () {
    Route::get('/student/home', [StudentAuthController::class, 'home'])->name('student.home');
    Route::get('/student/announcements', [StudentAuthController::class, 'announcements'])->name('student.announcements.index');
    Route::get('/student/announcements/{announcement}', [StudentAuthController::class, 'announcementShow'])->name('student.announcements.show');
    Route::get('/student/grades',[GradesController::class, 'studentGrades'])->name('student.grades');
});