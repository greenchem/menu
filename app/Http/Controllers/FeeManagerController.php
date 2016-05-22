<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

// Modal
use App\Objects\Company;
use App\Objects\Group;
use App\Objects\Period;
use App\Objects\CreationLog;

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
        return view('feeManager.dorm');
    }

    public function attendance() {
        return view('feeManager.attendance');
    }

    public function weekendAttendance() {
        return view('feeManager.weekendAttendance');
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

    public function booking() {
        $periods = Period::all();

        return view('feeManager.booking')
            ->with('periodData', $periods);
    }
}
