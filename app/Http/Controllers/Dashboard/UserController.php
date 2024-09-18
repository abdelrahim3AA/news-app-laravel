<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;



class UserController extends Controller
{
    use FileUploadTrait; 
    /**
     * Display a listing of the resource.
     *
     * return \Illuminate\Http\Response
     */
    public function index()
    {
        // Authorize based on policy method 'viewAny'
        if (Auth::user()->can(abilities: 'viewAny', User::class)) {
            // If user has the viewAny policy, return the users list
            $users = User::paginate(15);
        } else {
            // If not, return the authenticated user's data only
            $user = auth()->user(); 
            // Fetch the authenticated user’s data only
            $users = User::where('id', $user->id)->paginate(15);
        }

        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function create()
    {
        // Authorize based on policy method 'create'
        $this->authorize('create', User::class);
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // Authorize based on policy method 'create'
      $this->authorize('create', User::class);

        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'status' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'password' => ['required','string', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'status' => $request->status,
            'password' => Hash::make($request->password),
        ]);

        if ($request->hasFile('avatar')) {
            $path = $this->uploadFile($request->file('avatar'), 'dashboardImg/users');
            $user->update(['image' => $path]);
        }
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // Authorize based on policy method 'update'
        $this->authorize('update', $user);

        return view('dashboard.users.edit', compact('user')); 
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        // Authorize based on policy method 'update'
        $this->authorize('update', $user);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'max:255',
                'email', 
                Rule::unique('users')->ignore($user->id)
            ],
            'status' => ['nullable', 'string'],
            'phone_number' => ['required', 'string'],
        ]);

        $user->update($request->except('_token', 'avatar'));
        // dd($request->file('avatar'));
        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            $file_name = Str::uuid().$file->getClientOriginalName();
            $file->move(public_path('dashboardImg/users'), $file_name);
            $path = 'dashboardImg/users/'.$file_name;
            $res = $user->update(['image' => $path]);
        }
        // dd($res);
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Authorize based on policy method 'delete'
        $this->authorize('delete', $user);

        $user->delete(); 

        return to_route('dashboard.users.index')
        ->with('danger', 'Category go to the trush!'); 
    }
}
