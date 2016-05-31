<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use DB;

// Model
use App\Objects\Company;
use App\Objects\Period;
use App\Objects\UserQuota;
use App\Objects\BookingLog;

class UserController extends Controller
{
    public function menu() {
        $companies = Company::all();
        $periods = Period::all();
        $currentPeriod = -1;
        for($i=0; $i<count($periods); $i++) {
            if($periods[$i]->status == 'visible') {
                $currentPeriod = $periods[$i]->id;
                break;
            }
        }

        $quota = UserQuota::all();
        $user_id = Auth::user()->id;
        $currentQuota = 0;
        for($i=0; $i<count($quota); $i++) {
            if($quota[$i]->period_id == $currentPeriod && $quota[$i]->user_id==$user_id) {
                $currentQuota = $quota[$i]->quota;
                break;
            }
        }

        $paid = 0;
        if($currentPeriod != -1) {
            $bookingLog = BookingLog::where('period_id', '=', $currentPeriod)
                ->where('user_id', '=', $user_id)
                ->get();
            for($i=0; $i<count($bookingLog); $i++) {
                $paid += $bookingLog[$i]->price;
            }
        }


        return view('user.menu')
            ->with('paid', $paid)
            ->with('currentQuota', $currentQuota)
            ->with('currentPeriod', $currentPeriod)
            ->with('companyData', $companies);
    }

    public function shoppingCart() {
        $periods = Period::all();
        $currentPeriod = -1;
        for($i=0; $i<count($periods); $i++) {
            if($periods[$i]->status == 'visible') {
                $currentPeriod = $periods[$i]->id;
                break;
            }
        }

        $quota = UserQuota::all();
        $user_id = Auth::user()->id;
        $currentQuota = 0;
        for($i=0; $i<count($quota); $i++) {
            if($quota[$i]->period_id == $currentPeriod && $quota[$i]->user_id==$user_id) {
                $currentQuota = $quota[$i]->quota;
                break;
            }
        }

        $paid = 0;
        if($currentPeriod != -1) {
            $bookingLog = BookingLog::where('period_id', '=', $currentPeriod)
                ->where('user_id', '=', $user_id)
                ->get();
            for($i=0; $i<count($bookingLog); $i++) {
                $paid += $bookingLog[$i]->price;
            }
        }

        return view('user.shoppingCart')
            ->with('paid', $paid)
            ->with('currentPeriod', $currentPeriod)
            ->with('currentQuota', $currentQuota);
    }

    public function history() {
        $periods = Period::all();
        $products = json_encode(DB::table('products')->get());

        return view('user.history')
            ->with('productData', $products)
            ->with('periodData', $periods);
    }

    public function password() {
        return view('user.password');
    }
}

