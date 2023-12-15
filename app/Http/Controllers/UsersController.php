<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Redirect;

class UsersController extends Controller
{
    public function register() {
        $validator = Validator::make(
            array('password' => 'Пароли не совпадают!'),
            array('user_exists' => 'Пользователь уже существует!')
        );

        $inputs = request()->all();

        $name = request()->get('name');
        $login = request()->get('login');
        $password = request()->get('password');
        $password_confirmation = request()->get('password_confirmation');
        $email = request()->get('email');

        if($password != $password_confirmation) {
            $validator->errors()->add('password', 'Пароли не совпадают!');
            return Redirect::back()->withErrors($validator);
        }

        $users = DB::table('users')
            ->where('name', $name)
            ->where('email', $email)
            ->get();
        $user_count = $users->count();
        if($user_count > 0) {
            $validator->errors()->add('user_exists', 'Пользователь уже существует!');
            return Redirect::back()->withErrors($validator);
        }

        DB::insert('insert into users (name, login, password, email, access_rights) values (?, ?, ?, ?, ?)', [$name, $login, $password, $email, "user"]);

        request()->session()->put('logged_in', true);

        return redirect('/');
    }

    public function logout() {
        request()->session()->forget('logged_in');

        return redirect('/');
    }

    public function login() {
        $validator = Validator::make(
            array('no_such_user' => 'Пользователь не найден!'),
            array('password' => 'Пароли не совпадают!')
        );

        $inputs = request()->all();

        $login = request()->get('login');
        $password = request()->get('password');

        $user_count = DB::table('users')
            ->select('login', 'password')
            ->where('login', $login)
            ->where('password', $password)
            ->count();
        if($user_count == 0) {
            $validator->errors()->add('no_such_user', 'Пользователь не найден!');
            return Redirect::back()->withErrors($validator);
        }

        request()->session()->put('logged_in', true);

        return redirect('/');
    }
}
