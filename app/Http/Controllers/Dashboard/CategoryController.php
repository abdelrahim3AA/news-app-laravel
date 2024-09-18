<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check user authorization to view categories
        $this->authorize('viewAny', Category::class); // Use 'viewAny' for listing

        // Fetch all categories with their parent details using Eloquent relationships
        $categories = Category::with('parent')->select('categories.*')->paginate();
        
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Category::class);
        $categories = Category::whereNull('parent_id')->orWhere('parent_id',0)->paginate(); 
        return view('dashboard.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Category::class);
        $category = Category::create($request->except('image', '_token'));

        if ($request->hasFile('image')) {
            $path = $this->uploadFile($request->file('image'), 'dashboardImg/categories');
            $category->update(['image' => $path]);
        }
       
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $posts = $category->posts()->paginate();
        return view('dashboard.categories.show', compact('posts', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $this->authorize('update', $category);  // Check user authorization to edit category
        $categories = Category::whereNull('parent_id')->orWhere('parent_id',0)->paginate(); 
        return view('dashboard.categories.edit', compact(['category', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category);  // Check user authorization to update category

        $category->update($request->except('_token', 'image'));
        if ($request->file('image')) {
            $file = $request->file('image');
            $file_name = Str::uuid().$file->getClientOriginalName();
            $file->move(public_path('dashboardImg/categories'), $file_name);
            $path = 'dashboardImg/categories/'.$file_name;
            $res = $category->update(['image' => $path]);
        }
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Authorize the user to delete this specific category
        $this->authorize('delete', $category); 
        
        // Delete the category and its children
        $category->delete();
        
        return redirect()->route('dashboard.categories.index');
    }


    // public function delete(Request $request) {

    //     if (is_numeric($request->id)) {
    //         Category::where('id', '=', $request->id)->delete();
    //         Category::where('parent_id', '=', $request->id)->delete();
    //     }

    //     return redirect()->route('dashboard.categories.index');
    // }

}
