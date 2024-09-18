<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        // Fetch all categories, eager load their children and posts
        $categories_1 = Category::with('children', 'posts')
        ->paginate(6);

        // Pass the categories to the view
        return view('website.categories.index', compact('categories_1'));
    }
    public function show(Category $category)
    {
        // If you want to include children and posts, you can load them like this
        $category->load('children', 'posts');
        $categories = Category::with('children', 'posts')->get();
        // Pass the category to the view
        return view('website.categories.show', compact('category', 'categories'));
    }
}
