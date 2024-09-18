<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class IndexController extends Controller
{
    public function index()
    {
        
        $categories_1 = Category::with('children', 'posts')
        ->whereHas('posts')
        ->paginate(4);

        // dd($categories);
        return view('website.index', compact( 'categories_1'));
    }
}
