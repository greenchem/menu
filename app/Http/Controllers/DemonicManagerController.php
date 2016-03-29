<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DemonicManagerController extends Controller
{
    // Menu
    public function menuElement() {
        return view('demonic.manager.menu.element');
    }

    public function menuMenu() {
        return view('demonic.manager.menu.menu');
    }

    public function menuExport() {
        return view('demonic.manager.menu.export');
    }

    // Fee
    public function fee() {
        return view('demonic.manager.fee');
    }

    // Account
    public function account() {
        return view('demonic.manager.account');
    }
}
