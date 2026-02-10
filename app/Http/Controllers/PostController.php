<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
      
        $credentials = $request->validate([
            'title' => 'required', 
            'body' => 'required',
        ]);

        $credentials ['title'] = strip_tags($credentials['title']);
        $credentials ['body'] = strip_tags($credentials['body']);

        $credentials ['user_id'] = auth()->id();
        Post::create($credentials);
        
        return redirect('/');
    }
}
