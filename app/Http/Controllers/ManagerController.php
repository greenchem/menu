<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ManagerController extends Controller
{
    public function login() {
        return view('manager.login');
    }

    // Fee
    public function feeMeal() {
        return view('manager.fee.meal');
    }

    public function feeDorm() {
        return view('manager.fee.dorm');
    }

    public function feeAttendance() {
        return view('manager.fee.attendance');
    }

    public function feeWeekendAttendance() {
        return view('manager.fee.weekendAttendance');
    }

    public function feeParking() {
        return view('manager.fee.parking');
    }

    // Account
    public function account() {
        return view('manager.account.account');
    }
}

