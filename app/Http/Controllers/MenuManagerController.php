<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

// Modal
use App\Objects\Menu;
use App\Objects\Period;

class MenuManagerController extends Controller
{
    public function add() {
        $menus = Menu::where('company_id', Auth::user()->company->id)->get();
        $periods = Period::all();

        return view('menuManager.add')
            ->with('periodData', $periods)
            ->with('menuData', $menus);
    }

    public function edit($id) {
        $menu = Menu::find($id);
        $periods = Period::all();

        return view('menuManager.edit')
            ->with('menuData', $menu)
            ->with('periodData', $periods);
    }

    public function menu() {
        $menus = Menu::where('company_id', Auth::user()->company->id)->get();
        $periods = Period::all();

        return view('menuManager.menu')
            ->with('menuData', $menus)
            ->with('periodData', $periods);
    }

    public function export() {
        return view('menuManager.export');
    }
}

