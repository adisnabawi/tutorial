<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $main = Posts::latest()->first();
        $posts = Posts::latest()->skip(1)->take(2)->get();
        return view('index', compact('main', 'posts'));
    }
    
}
