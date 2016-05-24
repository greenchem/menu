<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

// Model
use App\Objects\Company;
use App\Objects\Period;

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
        $periods = Period::all();
        $products = json_encode(DB::table('products')->get());

        return view('user.history')
            ->with('productData', $products)
            ->with('periodData', $periods);
    }
}

