<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

// Model
use App\Objects\Company;
use App\Objects\Group;

class MasterController extends Controller
{
    // who can edit fee
    public function editFeeSetting() {
        $companies = Company::all();
        $groups = Group::with(['company'])->get();

        return view('master.editFeeSetting')
            ->with('companyData', $companies)
            ->with('groupData', $groups);
    }
}

