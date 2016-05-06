<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FeeManagerController extends Controller
{
    public function meal() {
        return view('feeManager.meal');
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
        return view('feeManager.parking');
    }

}
