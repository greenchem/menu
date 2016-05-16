<?php

namespace App\Http\Controllers\Api\AccountSys;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// System using
use Auth;

class AuthController extends Controller
{
    /**
     * Login with the provided username & password
     *
     * @var Illiminate\Http\Request
     */
    public function login(Request $request)
    {
        Auth::attempt([
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ]);

        return response()->json(['status' => ( Auth::check() ? 0 : 1 )]);
    }

    /**
     * For user to logout
     *
     */
    public function logout()
    {
        Auth::logout();
        return Redirect::to('/');

        //return response()->json(['status' => !Auth::check()]);
    }
}
