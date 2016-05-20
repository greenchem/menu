<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

// Model
use App\Objects\Company;
use App\Objects\Period;
use App\Objects\Product;

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
        $products = Product::all();

        return view('user.history')
            ->with('periodData', $periods)
            ->with('productData', $products);
    }
}

