<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Middleware so that a user must be logged in to use any of the functions in this controller
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show the user their profile
    public function show(User $user)
    {
        $data = array(
            'user' => $user
        );
        return view('user.profile')->with($data);
    }

    // Update the users information
    public function update(Request $request, User $user)
    {
        //Validate form data
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', $user->email != $request->email ? 'unique:users' : '']
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back();
    }
}
