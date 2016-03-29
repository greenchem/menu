<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DemonicUserController extends Controller
{
    public function menu() {
        return view('demonic.user.menu');
    }

    public function fee() {
        return view('demonic.user.fee');
    }
}
