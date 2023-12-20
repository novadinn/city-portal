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

Route::get('/request-change-status/{id}', function ($id) {
    return view('request-change-status', ['id' => $id]);
});

Route::post('/request', [RequestsController::class, 'createNew'])->name('createNew');

Route::post('/request-delete', [RequestsController::class, 'delete'])->name('delete');

Route::get('/request-status', function () {
    $inputs = request()->all();
    $id = request()->get('id');

    return redirect('request-change-status/'.$id);
});

Route::post('/request-change-status', [RequestsController::class, 'changeStatus'])->name('changeStatus');

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [UsersController::class, 'register'])->name('register');

Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

Route::post('/login', [UsersController::class, 'login'])->name('login');