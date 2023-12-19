<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Redirect;

class RequestsController extends Controller
{
    public function createNew() {
        $inputs = request()->all();

        $name = request()->get('name');
        $category = request()->get('category');
        $description = request()->get('description');
        $photo_path = request()->get('photo_path');
        
        DB::insert('insert into requests (user_login, name, category, description, status, photo_path, created_at) values (?, ?, ?, ?, ?, ?, ?)', [session()->get('login'), $name, $category, $description, 'Новая', $photo_path, now()]);

        return redirect('/profile');
    }

    public function delete() {
        $inputs = request()->all();

        $id = request()->get('id');

        DB::table('requests')->delete($id);

        return redirect('/profile');
    }
}
