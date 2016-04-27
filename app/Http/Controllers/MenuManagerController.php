<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MenuManagerController extends Controller
{
    public function login() {
        return view('menuManager.login');
    }

    public function add() {
        return view('menuManager.add');
    }

    public function edit($id) {
        if(!$id) {
            return view('menuManager.menu');
        }else {
            return view('menuManager.edit');
        }
    }

    public function menu() {
        $menu = [
            ['id'=>1, 'name'=>'春節菜單'],
            ['id'=>2, 'name'=>'端午菜單']
        ];

        return view('menuManager.menu')
            ->with('menu', $menu);
    }

    public function export() {
        return view('menuManager.export');
    }
}

