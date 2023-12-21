<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Redirect;

class CategoriesController extends Controller
{
    public function create() {
        $inputs = request()->all();

        $name = request()->get('name');
        
        DB::insert('insert into categories (name) values (?)', [$name]);

        return redirect('/categories');
    }

    public function delete() {
        $inputs = request()->all();

        $name = request()->get('categories');
        $category = DB::table('categories')->where('name', $name)->get()->first();

        DB::table('categories')->delete($category->id);

        return redirect('/categories');
    }
}
