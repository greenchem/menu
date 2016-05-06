<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MasterController extends Controller
{
    // Menu
    public function menu() {
        return view('master.menu.index');
    }
}

