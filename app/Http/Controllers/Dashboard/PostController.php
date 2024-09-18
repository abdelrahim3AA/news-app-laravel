<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use App\Models\Post; 
use App\Models\Category; 
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use FileUploadTrait; 
    /**
     * Display a listing of the resource.
     *
     * return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category')->paginate(10);
        // dd($posts);
        return view('dashboard.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        // $categories = [];
        if (count($categories) > 0) {
            return view('dashboard.posts.create', compact('categories'));
        }
        abort(403, 'You Cannot create a new Post with no categories.');
    }

    /**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function store(Request $request)
{
    // Start with some basic validation rules
    $rules = [
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate the image
        'category_id' => 'required|exists:categories,id', // Validate category
    ];

    // Loop through each language and add validation rules for each
    foreach (config('app.languages') as $key => $lang) {
        $rules["$key.title"] = 'nullable|string|max:255'; // Validate title for each language
        $rules["$key.content"] = 'nullable|string'; // Validate content for each language
        $rules["$key.smallDesc"] = 'nullable|string|max:500'; // Validate small description for each language
        $rules["$key.tags"] = 'nullable|string'; // Validate tags for each language (nullable)
    }

    // Apply the validation rules
    $validatedData = $request->validate($rules);

    // Add the user_id to the validated data array
    $validatedData['user_id'] = Auth::user()->id;

    // dd($validatedData);
    // Create a new post with the validated data
    $post = Post::create($validatedData);

    // If the image was uploaded, update the post with the new image path
    if ($request->hasFile('image')) {
        $path = $this->uploadFile($request->file('image'), 'dashboardImg/posts');
        $post->update(['image' => $path]);
    }
    // Return a success response
    return redirect()->route('dashboard.posts.index')->with('success', 'Post created successfully.');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        // Check if the current user has permission to edit the post
        $post = Post::with('category')->findOrFail($id);

        // Check if the user has permission to edit the post
        $this->authorize('update', $post);

        // Fetch all categories for the select dropdown
        $categories = Category::all(); // Fetch all categories for the select dropdown

        return view('dashboard.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        // Check if the current user has permission to update the post
        $this->authorize('update', $post);

        // Define validation rules for each language
        $rules = [
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        foreach (config('app.languages') as $key => $lang) {
            $rules["$key.title"] = 'nullable|string|max:255'; // Validate title for each language
            $rules["$key.smallDesc"] = 'nullable|string|max:500'; // Validate small description for each language
            $rules["$key.content"] = 'nullable|string'; // Validate content for each language
            $rules["$key.tags"] = 'nullable|string'; // Validate tags for each language (nullable)
        }

        // Validate the incoming request data
        $validatedData = $request->validate($rules);

        // Prepare the translations array
        $translations = [];
        foreach (config('app.languages') as $key => $lang) {
            $translations[$key] = [
                'title' => $validatedData[$key]['title'] ?? null,
                'content' => $validatedData[$key]['content'] ?? null,
                'smallDesc' => $validatedData[$key]['smallDesc'] ?? null,
                'tags' => $validatedData[$key]['tags'] ?? null,
            ];
        }

        // Update the post with validated data and translations
        $post->update([
            'category_id' => $validatedData['category_id'],
        ]);

        // Save the translations (assuming you handle translations manually)
        foreach ($translations as $locale => $translationData) {
            $post->translateOrNew($locale)->title = $translationData['title'];
            $post->translateOrNew($locale)->content = $translationData['content'];
            $post->translateOrNew($locale)->smallDesc = $translationData['smallDesc'];
            $post->translateOrNew($locale)->tags = $translationData['tags'];
        }
        $post->save();

        // Check if an image was uploaded and handle the file upload
        if ($request->hasFile('image')) {
            $path = $this->uploadFile($request->file('image'), 'dashboardImg/posts');
            $post->update(['image' => $path]);
        }

        // Redirect with success message
        return redirect()->route('dashboard.posts.index')->with('success', 'Post updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
        {
            // Check if the user has permission to delete the post
            $this->authorize('delete', $post);

            $post->delete(); // Perform the delete operation

            return redirect()->route('dashboard.posts.index')->with('success', 'Post deleted successfully.');
        }
}
