<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

// Model
use App\Objects\Company;

class UserController extends Controller
{
    public function menu() {
        $companies = Company::all();

        return view('user.menu')
            ->with('companyData', $companies);
    }

    public function shoppingCart() {
        return view('user.shoppingCart');
    }

    public function history() {
        return view('user.history');
    }
}

