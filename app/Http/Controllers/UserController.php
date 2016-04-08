<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function menu() {
        return view('user.menu');
    }

    public function shoppingCart() {
        return view('user.shoppingCart');
    }

    public function history() {
        return view('user.history');
    }

    public function fee() {
        return view('user.fee');
    }
}
