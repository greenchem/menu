<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ManagerController extends Controller
{
    // Menu
    public function menuAdd() {
        return view('manager.menu.add');
    }

    public function menuEdit($id) {
        if(!$id) {
            return view('manager.menu.menu');
        }else {
            return view('manager.menu.edit');
        }
    }

    public function menuMenu() {
        $menu = [
            ['id'=>1, 'name'=>'春節菜單'],
            ['id'=>2, 'name'=>'端午菜單']
        ];

        return view('manager.menu.menu')
            ->with('menu', $menu);
    }

    public function menuExport() {
        return view('manager.menu.export');
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
