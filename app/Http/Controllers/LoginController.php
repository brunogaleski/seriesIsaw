<?php

namespace App\Http\Controllers;

use \Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller {

    public function showLogin() {
        return view('login');
    }

    public function doLogin(Request $request) {
        $userData = $request->except(['_token', '_method']);

        $validator = Validator::make($userData, [
            'username' => 'required|min:3',
            'password' => 'required|alphaNum|min:3'
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withInput(collect($userData)->except(['password'])->toArray())
                ->withErrors($validator);
        } else {
            if (Auth::attempt($userData)) {
                if (Auth::user()->isAdmin()) {
                    return redirect()->route('series.list');
                } else {
                    return redirect()->route('seriesHistory.list');
                }


            }

            return redirect()->route('login')
                ->withErrors([
                    'error' => 'Username or password incorrect'
                ]);
        }
    }

    public function doLogout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
