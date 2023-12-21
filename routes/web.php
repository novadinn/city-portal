<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\CategoriesController;

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

Route::get('/request-status', function () {
    $inputs = request()->all();
    $id = request()->get('id');

    return redirect('request-change-status/'.$id);
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/categories', function() {
    if(session('login') == 'admin') {
        return view('categories');
    }

    return view('/profile');
});

Route::get('/requests', function() {
    return view('requests');
});

Route::post('/request', [RequestsController::class, 'createNew'])->name('createNew');

Route::post('/request-delete', [RequestsController::class, 'delete'])->name('delete');

Route::post('/request-change-status', [RequestsController::class, 'changeStatus'])->name('changeStatus');

Route::post('/register', [UsersController::class, 'register'])->name('register');

Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

Route::post('/login', [UsersController::class, 'login'])->name('login');

Route::post('/category', [CategoriesController::class, 'create'])->name('create');

Route::post('/category-delete', [CategoriesController::class, 'delete'])->name('delete');