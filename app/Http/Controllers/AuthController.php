<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login.index');
    }

    public function post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credent = $request->only('username', 'password');
        if (Auth::attempt($credent)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('admin');
            } else if ($user->role == 'superadmin') {
                return redirect()->route('superadmin');
            } else {
                return redirect()->route('member');
            }
        }

        Session::flash('error', 'Username atau Password Salah!');
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        Auth::logout();

        return redirect()->route('login');
    }
}
