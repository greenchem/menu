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

        return view('accountManager.account')
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
