<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

// Model
use App\Objects\Company;
use App\Objects\Group;

class AccountManagerController extends Controller
{
    //
    public function account() {
        return view('accountManager.account');
    }
    public function company() {
        $companies = Company::all();
        $groups = Group::with(['company'])->get();

        return view('accountManager.company')
            ->with('companyData', $companies)
            ->with('groupData', $groups);
    }
    
}
