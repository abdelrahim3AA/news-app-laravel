<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;


class PostController extends Controller
{
    public function show($id)
    {
        $post = Post::find($id);
        $tags = explode(',', $post->tags);
        $relatedPosts = Post::where('category_id', $post->category_id)
                         ->where('id', '!=', $post->id) // Exclude the current post
                         ->latest() // You can adjust this as needed
                         ->get();
        $categories = Category::with('children', 'posts')->get();
        return view('website.posts.index', compact('post', 'relatedPosts',  'categories', 'tags'));
    }
}
