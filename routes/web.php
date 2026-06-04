<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UangKuliahController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\SkpiController;
use App\Http\Controllers\IPKController;
use App\Http\Controllers\AnnouncementController;

Route::get('/', function () {
    return redirect('/home');
});

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

Route::get('/uang-kuliah', [UangKuliahController::class, 'index']);

// route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// route buat home
Route::get('/home', [AuthController::class, 'home'])->middleware('auth')->name('home');
Route::middleware('auth')->group(function () {

    Route::get('/grades/{studentId}', [GradesController::class, 'getStudentGrades']);
    Route::resource('/home/grades', GradesController::class);
    
});

Route::prefix('uang-kuliah')->group(function () {
    Route::get('/', [UangKuliahController::class, 'index']);
    Route::get('/menu', [UangKuliahController::class, 'menu']);
    Route::get('/payment-scheme', [UangKuliahController::class, 'showScheme']);
    Route::post('/payment-scheme', [UangKuliahController::class, 'saveScheme']);
});

// route untuk matkul
route::get('/matkul',[MatkulController::class, 'index']);
route::get('/matkul/{id}',[MatkulController::class, 'show']);
route::post('/matkul',[MatkulController::class, 'store']);
route::put('/matkul/{id}',[MatkulController::class, 'update']);
route::delete('/matkul{id}',[MatkulController::class, 'destroy']);
route::resource('matkul', MatkulController::class);

// route untuk register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

// route untuk skpi
Route::resource('skpi', SkpiController::class);

//route untuk IPK
Route::get('/students/{student}/ipk', [IPKController::class, 'show']);

//route untuk announcements
Route::middleware('auth')->group(function () {
    Route::resource('announcements', AnnouncementController::class);
});