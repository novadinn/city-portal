<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Redirect;

class RequestsController extends Controller
{
    public function createNew() {
        $inputs = request()->all();
        $photo_file = request()->file('photo'); 
        $name = request()->get('name');
        $category = request()->get('category');
        $description = request()->get('description');
        $photo_binary = request()->get('photo_binary');
        $photo_path = request()->get('photo_path');

        Storage::disk('public')->put("images/{$photo_path}",  $photo_binary);

        DB::insert('insert into requests (user_login, name, category, description, status, photo_path, created_at) values (?, ?, ?, ?, ?, ?, ?)', [session()->get('login'), $name, $category, $description, 'Новая', $photo_path, now()]);

        return redirect('/profile');
    }

    public function delete() {
        $inputs = request()->all();

        $id = request()->get('id');

        DB::table('requests')->delete($id);

        return redirect('/profile');
    }

    public function changeStatus() {
        $inputs = request()->all();

        $id = request()->get('id');
        $status = request()->get('statuses');

        if($status == 'solved') {
            $photo = request()->get('photo_path');
            DB::table('requests')
                ->where('id', $id) 
                ->limit(1)
                ->update(array('status' => 'Решена', 'photo_path_solved' => $photo)); 
        } else if($status == 'declined') {
            DB::table('requests')
                ->where('id', $id) 
                ->limit(1)
                ->update(array('status' => 'Отклонена')); 
        }

        return redirect('request-change-status/'.$id);
    }
}
