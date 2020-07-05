<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\DataTables\UserDataTable;
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
        
        //// Check time is between
        // $time = Carbon::now(); // Current time
        // $start = Carbon::create($time->year, $time->month, $time->day, 7, 0, 0); //set time to 10:00
        // $end = Carbon::create($time->year, $time->month, $time->day, 24, 0, 0); //set time to 18:00

        // if(now() < $end && now() > $start){
        //     return 'time between';
        // }
        // else{
        //     return 'not now';
        // }
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


        $current_user = new User;
        $input = $request->all();
        $current_user->email_verified_at = now();
        $current_user->role = 'user';
        $current_user->fill($input);

        $current_user->save();
        return redirect('users/create')->with(['message' => 'User created!', 'alert' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
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
            'email' => 'required|unique:users|max:255',
            'name' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required_with:password',
        ]);

        $current_user = User::find($user->id);
        $input = $request->except('password');
        $current_user->fill($input);

        if ($request->filled('password')) {
            $current_user->fill(['password' => Hash::make($request->password)]);
        }

        $current_user->save();
        return redirect('users/' . $current_user->id . '/edit')->with(['message' => 'Profile updated!', 'alert' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
