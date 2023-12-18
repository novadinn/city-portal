<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RequestsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/request/{id}', function ($id) {
    return view('request', ['id' => $id]);
});

Route::post('/request', [RequestsController::class, 'createNew'])->name('createNew');

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [UsersController::class, 'register'])->name('register');

Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

Route::post('/login', [UsersController::class, 'login'])->name('login');

Route::get('/test', function() {
    DB::delete('delete from users');
    request()->session()->forget('logged_in');
    request()->session()->forget('login');
    return redirect('/');
});