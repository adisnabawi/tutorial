<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// [] == array
// {} == object == Object()
Route::prefix('blog')->group(function () {
    Route::get('/', [HomeController::class, 'blog'])->name('blog');
    Route::get('/{id}', [HomeController::class, 'blogID'])->name('blog.id');
});

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::prefix('userverified')->middleware('auth', 'admin')->group(function () {
    Route::match(['get', 'post'],'/', [HomeController::class, 'index'])->name('hello');
    Route::post('/post-blog', [HomeController::class, 'verify'])->name('hello.verify');
});

Route::resources([
    'photos' => PhotoController::class,
]);

Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/signup', function () {
    if(Auth::check()) return redirect()->route('index');
    return view('signup');
})->name('signup');

Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/signup/create', [LoginController::class, 'signup'])->name('signup.create');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

