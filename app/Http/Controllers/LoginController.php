<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function register(Request $request)
    {

        $validated = $request->validate([
            'username' => 'required|max:30',
            'email' => 'required',
            'password' => 'required|min:8|regex:/[A-Z]/|regex:/[0-9]/',
        ], [
            'username.required' => 'The field "username" is required.',
            'username.max' => 'The username cannot have more than 30 characters.',
            'email' => 'The field "email" is required.',
            'password.required' => 'The field "password" is required.',
            'password.min' => 'The password must have atleast 8 characters.',
            'password.regex' => 'The password must contain at least one uppercase letter and one number.'
        ]);
    
        // Validar

        $user = new User();
        // $user->username = $request->username;
        $user->username = $validated['username'];
        // $user->email = $request->email;
        $user->email = $validated['email'];

        if($validated['password']) {
             $user->password = Hash::make($request->password);
        }

        $user->save();

        Auth::login($user);

        return redirect()->route('list.index');
    }
    public function login(Request $request)
    {

    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ], [
        'username.required' => 'The username or email is required.',
        'password.required' => 'The password is required.',
    ]);

    $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    $credentials = [
        $loginType => $request->username,
        'password' => $request->password,
    ];

        $remember = $request->has('rememberToken') ? true : false;

        //$remember = ($request->has('remember') ? true : false);
   if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();
        return redirect()->route('list.index');
    }

    // Retornar un error si l'autenticació falla
    return back()->withErrors([
        'username' => 'The provided credentials are incorrect.',
    ])->onlyInput('username');
    
    }
    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect()->route('list.index');
    }
}
