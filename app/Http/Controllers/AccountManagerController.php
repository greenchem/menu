<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

// Model
use App\Objects\Company;
use App\Objects\Group;
use App\Objects\User;

class AccountManagerController extends Controller
{
    //
    public function account() {
        $companies = Company::all();
        $groups = Group::with(['company'])->get();

        for($j=0; $j<count($groups); $j++)
        {
            for($i=0; $i<count($groups); $i++)
            {
                if($groups[$j]['company_id'] < $groups[$i]['company_id'])
                {
                    $temp = $groups[$j];
                    $groups[$j] = $groups[$i];
                    $groups[$i] = $temp;
                }
            }
        }

        $user_id = Auth::user()->id;
        $user = User::where('id', '=', $user_id)
            ->with('roles')
            ->get();
        $user = json_decode($user);

        $admin = 0;
        for($i=0; $i<count($user[0]->roles); $i++) {
            if($user[0]->roles[$i]->name == 'Admin') {
                $admin = 1;// check now is admin or not?
            }
        }

        return view('accountManager.account')
            ->with('admin', $admin)
            ->with('companyData', $companies)
            ->with('groupData', $groups);
    }

    public function company() {
        $companies = Company::all();
        $groups = Group::with(['company'])->get();

        for($j=0; $j<count($groups); $j++)
        {
            for($i=0; $i<count($groups); $i++)
            {
                if($groups[$j]['company_id'] < $groups[$i]['company_id'])
                {
                    $temp = $groups[$j];
                    $groups[$j] = $groups[$i];
                    $groups[$i] = $temp;
                }
            }
        }

        return view('accountManager.company')
            ->with('companyData', $companies)
            ->with('groupData', $groups);
    }
}

