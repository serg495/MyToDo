<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::add($request->all());
        $user->generatePassword($request->password);

        return redirect()->route('login');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ])) {
            return redirect('/tasks');
        } else {
            return redirect()->back()->with('status', 'Неверный логин/пароль');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
