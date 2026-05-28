<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UangKuliahController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\MatkulController;
Route::get('/', function () {
    return redirect('/home');
});

use Illuminate\Support\Facades\DB;

Route::get('/vulnerable', function () {
    $name = request('name');
    $user = DB::select("SELECT * FROM users WHERE name = ?", [$name]);
    return $user;
});
Route::resource('posts', PostController::class);

Route::middleware('auth')->group(function() {
    Route::resource('posts', PostController::class);
});
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


//students
// route public buat students
Route::get('/students',              [StudentController::class, 'index']);
Route::get('/students/{studentId}',  [StudentController::class, 'show']);
Route::put('/students/{studentId}',  [StudentController::class, 'update']);
Route::resource('students', StudentController::class);

// route protected yg harus pake authorization
Route::middleware('auth')->group(function () {
    Route::resource('students', StudentController::class);
    Route::post('/students',             [StudentController::class, 'store']);
    Route::delete('/students/{studentId}', [StudentController::class, 'destroy']);
});

Route::get('/uang-kuliah', [UangKuliahController::class, 'index']);

// route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// route buat home
Route::get('/home', [AuthController::class, 'home'])->middleware('auth')->name('home');
Route::middleware('auth')->group(function () {
    // POST
    Route::post('/grades', [GradesController::class, 'store']);

    // DELETE
    Route::delete('/api/grades/{grade_id}', [GradesController::class, 'destroy']);

    // GET
    Route::get('/api/grades/uts/{studentId}', [GradesController::class, 'getUTS']);

    Route::get('/api/grades/uas/{studentId}', [GradesController::class, 'getUAS']);

    Route::get('/api/grades/tugas/{studentId}', [GradesController::class, 'getTUGAS']);
});

Route::get('/uang-kuliah', [UangKuliahController::class, 'index']);

// route untuk matkul
route::get('/matkul',[MatkulController::class, 'index']);
route::get('/matkul/{id}',[MatkulController::class, 'show']);
route::post('/matkul',[MatkulController::class, 'store']);
route::put('/matkul/{id}',[MatkulController::class, 'update']);
route::delete('/matkul{id}',[MatkulController::class, 'destroy']);
route::resource('matkul', MatkulController::class);