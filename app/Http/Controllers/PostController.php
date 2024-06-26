<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Mockery\Exception\InvalidOrderException;

class PostController extends Controller
{
    public function index()
    {

        return view('posts.index', [
            // 'posts' => Post::latest()->with('category', 'author')->get()
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(4)->withQueryString(),
            'categories' => Category::all()

        ]);

    }


    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }
    
}
