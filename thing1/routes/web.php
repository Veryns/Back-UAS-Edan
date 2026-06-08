<?php
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/vulnerable', function () {
    $name = request('name');
    $route = DB::select("SELECT * FROM users WHERE name = ?", [$name]);
    return $route;
    });
#Route::get('/', function () {
#   return redirect('/posts');
Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::resource('posts', PostController::class);
