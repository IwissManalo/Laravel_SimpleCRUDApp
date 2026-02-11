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

    public function showEditPostForm(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
           return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }
 
    public function updatePost(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return redirect('/');
        }

        $credentials = $request->validate([
            'title' => 'required', 
            'body' => 'required',
        ]);

        $credentials ['title'] = strip_tags($credentials['title']);
        $credentials ['body'] = strip_tags($credentials['body']);
 
        $post->update($credentials);
        
        return redirect('/');
    }

    public function deletePost(Post $post)
    {
        if ($post->user_id === auth()->id()) {
            $post->delete();
        }
        return redirect('/');
    }
}
