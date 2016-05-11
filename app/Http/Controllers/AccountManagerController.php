<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AccountManagerController extends Controller
{
    //
    public function account() {
        return view('accountManager.account');
    }
    public function company() {
        return view('accountManager.company');
    }
    
}
