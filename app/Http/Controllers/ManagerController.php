<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ManagerController extends Controller
{
    // Menu
    public function menuElement() {
        return view('manager.menu.element');
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
    public function fee() {
        return view('manager.fee');
    }

    // Account
    public function account() {
        return view('manager.account');
    }
}
