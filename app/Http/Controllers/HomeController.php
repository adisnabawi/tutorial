<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $posts = Posts::get();
        $name = $request->name;
        $photo = "Test";
        return view('hello', compact('name', 'photo', 'posts'));
    }

    public function verify(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:3',
        ]);
        $post = new Posts;
        $post->title = $request->name;
        $post->content = "Lorem ipsum";
        $post->user_id = Auth::user()->id;
        $post->save();
        return redirect()->back();
    }

    public function blog(Request $request){
        $posts = Posts::with('user')->paginate(2);
        return view('blog', compact('posts'));
    }

    public function blogID($id){
        $post = Posts::with('user')->where('id', $id)->first();
        return view('blogcontent', compact('post'));
    }
}
