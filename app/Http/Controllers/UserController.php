<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function login() {
        return view('user.login');
    }

    public function menu() {
        return view('user.menu');
    }

    public function shoppingCart() {
        return view('user.shoppingCart');
    }

    public function history() {
        return view('user.history');
    }

    // Fee
    public function feeMeal() {
        return view('user.fee.meal');
    }

    public function feeDorm() {
        return view('user.fee.dorm');
    }

    public function feeAttendance() {
        return view('user.fee.attendance');
    }

    public function feeWeekendAttendance() {
        return view('user.fee.weekendAttendance');
    }

    public function feeParking() {
        return view('user.fee.parking');
    }
}
