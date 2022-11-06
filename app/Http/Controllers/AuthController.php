<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function authenticate(Request $request)
    {
        if (in_array('', $request->only('email', 'password'))) {
            return redirect()->route('auth.login')->with(['color' => 'danger', 'message' => 'Enter the email and the password to access!']);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($credentials)) {
            return redirect()->route('auth.login')->with(['color' => 'danger', 'message' => 'Ooops, incorrect username and password!']);
        }

        $this->authenticated($request->getClientIp());

        return redirect()->route('index')->with(['color' => 'success', 'message' => 'User created successfully.']);
    }

    public function createUser(Request $request)
    {
        $params = $request->all();

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        if ($params['password'] != $params['remember_password']) {
            return redirect()->route('auth.register')->with(['color' => 'danger', 'message' => 'Passwords do not match.']);
        }

        $params['password'] = Hash::make($params['password']);

        $newUser = new User($params);
        $newUser->save();
        return redirect()->route('index')->with(['color' => 'success', 'message' => 'User created successfully.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }

    private function authenticated(string $ip)
    {
        $user = User::where('id', Auth::user()->id);
        $user->update([
            'last_login_at' => date('Y-m-d H:i:s'),
            'last_login_ip' => $ip
        ]);
    }
}
