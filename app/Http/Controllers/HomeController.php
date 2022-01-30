<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\SubscribeNoti;
use Illuminate\Support\Facades\Notification;
use Faker\Generator;
use Illuminate\Container\Container;
use App\Events\MyEvent;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $posts = Posts::latest()->paginate(5);
        return view('hello', compact('posts'));
    }

    public function verify(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:3',
        ]);
        $sampleText = '';
        $faker = Container::getInstance()->make(Generator::class);
        $faker = \Faker\Factory::create('en_US');
        for($i=0; $i < 10; $i++){
            $sampleText = $sampleText . $faker->realText(500) . ' <br> <br>';
            if($i == 3 || $i == 8){
                $response = Http::get('https://picsum.photos/v2/list?page='.rand(0, 500).'&limit=1');
                $imageUrl = $response->json();
                $sampleText = $sampleText . '<img src="'. $imageUrl[0]['download_url'] .'" width="100%"/> <br><br>';
            }
        }
        $post = new Posts;
        $post->title = $request->name;
       
        $post->content = $sampleText;
        $post->user_id = Auth::user()->id;
        $post->save();
        if($post){
            $newPost = array('name' => Auth::user()->name, 'title' => $post->title, 
            'content' => Str::limit($post->content, 100), 'id' => $post->id); 
            $user = User::first();
            event(new MyEvent($newPost));
            Notification::send($user,new SubscribeNoti($newPost));
        }
        return redirect()->back();
    }

    public function blog(Request $request){
        $posts = Posts::with('user')->latest()->paginate(5);
        return view('blog', compact('posts'));
    }

    public function blogID($id){
        $post = Posts::with('user')->where('id', $id)->first();
        return view('blogcontent', compact('post'));
    }
}
