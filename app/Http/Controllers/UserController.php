<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\DataTables\UserDataTable;
use App\Models\Quota;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {
        $user = \Auth::user();
        return $dataTable->render('users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:users|max:255',
            'name' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required_with:password',
        ]);


        $user_data = new User;
        $input = $request->except('password');
        $user_data->email_verified_at = now();
        $user_data->role = 'user';
        $user_data->password = Hash::make($request->password);
        $user_data->fill($input);
        $user_data->save();

        $quota_data = new Quota;
        $quota_data->user_id = $user_data->id;
        $quota_data->balance = 0;
        $quota_data->save();
        return redirect('users/create')->with(['message' => 'User created!', 'alert' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $user_data = User::where('name', $username)->first();
        return view('users.view', compact('user_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|max:255|unique:users,email,' . $user->id . ',id',
            'name' => 'required',
            'password' => 'nullable|confirmed',
            'password_confirmation' => 'required_with:password',
        ]);

        $user_data = User::find($user->id);
        $input = $request->except('password');
        $user_data->fill($input);

        if ($request->filled('password')) {
            $user_data->fill(['password' => Hash::make($request->password)]);
        }

        $user_data->save();
        return redirect('users/' . $user_data->id . '/edit')->with(['message' => 'Profile updated!', 'alert' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user_data = User::find($user->id);
        $user_data->delete();
        
    }
}
