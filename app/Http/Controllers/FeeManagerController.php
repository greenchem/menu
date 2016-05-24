<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

// Modal
use App\Objects\Company;
use App\Objects\Group;
use App\Objects\Period;
use App\Objects\CreationLog;
use App\Objects\User;

class FeeManagerController extends Controller
{
    public function meal() {
        $companies = Company::all();
        $groups = Group::all();

        return view('feeManager.meal')
            ->with('companyData', $companies)
            ->with('groupData', $groups);
    }

    public function dorm() {
        $companies = Company::all();
        $groups = Group::all();

        return view('feeManager.dorm')
            ->with('companyData', $companies)
            ->with('groupData', $groups);
    }

    public function attendance() {
        $companies = Company::all();
        $groups = Group::all();

        return view('feeManager.attendance')
            ->with('companyData', $companies)
            ->with('groupData', $groups);
    }

    public function weekendAttendance() {
        $companies = Company::all();
        $groups = Group::all();

        return view('feeManager.weekendAttendance')
            ->with('companyData', $companies)
            ->with('groupData', $groups);
    }

    public function parking() {
        $companies = Company::all();
        $groups = Group::all();

        return view('feeManager.parking')
            ->with('companyData', $companies)
            ->with('groupData', $groups);
    }

    public function period() {
        return view('feeManager.period');
    }

    public function feeExport() {
        return view('feeManager.feeExport');
    }

    public function booking() {
        $periods = Period::all();
        $products = json_encode(DB::table('products')->get());

        return view('feeManager.booking')
            ->with('productData', $products)
            ->with('periodData', $periods);
    }
}
