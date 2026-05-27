<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UangKuliahController;
use App\Http\Controllers\GradesController;

Route::get('/', function () {
    return redirect('/posts');
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
 
// route protected yg harus pake authorization
Route::middleware('auth')->group(function () {
    Route::post('/students',             [StudentController::class, 'store']);
    Route::delete('/students/{studentId}', [StudentController::class, 'destroy']);
});

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