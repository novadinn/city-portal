<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function register() {
        $inputs = request()->all();

        $name = request()->get('name');
        $login = request()->get('login');
        $password = request()->get('password');
        $password_confirmation = request()->get('password_confirmation');
        $email = request()->get('email');

        if($password != $password_confirmation) {
            // TODO:
        }

        $user_count = DB::table('users')
            ->select('name', 'email')
            ->where('name', $name)
            ->where('email', $email)
            ->count();
        if($user_count > 0) {
            // TODO:
        }

        DB::table('users')->insert(
            array(
                'name' => $name,
                'login' => $login,
                'password' => $password,
                'email' => $email
            )
        );

        request()->session()->put('logged_in', true);

        return redirect('/');
    }

    public function logout() {
        request()->session()->forget('logged_in');

        return redirect('/');
    }

    public function login() {
        $inputs = request()->all();

        $login = request()->get('login');
        $password = request()->get('password');

        $user_count = DB::table('users')
            ->select('login', 'password')
            ->where('login', $login)
            ->where('password', $password)
            ->count();
        if($user_count > 0) {
            // TODO:
        } else {
            request()->session()->put('logged_in', true);
        }

        return redirect('/');
    }
}
