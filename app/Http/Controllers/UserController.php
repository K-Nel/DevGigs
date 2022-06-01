<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create(){
        return view('Users.register');
    }

    public function store(){
        $createUserForm = request()->validate([
            'name' => ['required', 'min:4'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'confirmed']
        ]);

        $createUserForm['password'] = bcrypt($createUserForm['password']);

        $user = User::create($createUserForm);
        auth()-> login($user);

        return redirect('/')->with('message', 'Registration successful');
    }

    public function logout(){
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }

    public function login(){
        return view('users.login');
    }

    public function signin(){
        $loginUserForm = request()->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($loginUserForm)) {
            request()->session()->regenerate();
            return redirect('/')->with('message', 'You are now logged in!');
        }
        else {
            return back()->withErrors(['email'=>'Invalid Credentials'])->onlyInput('email');
        }
    }
}
