<?php

namespace App\Http\Controllers\Api\MenuSys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

// System
use Auth;

// Model
use App\Objects\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menus = Menu::where('status', 'visible')->where('company_id', $request->input('company_id'))->get();

        return response()->json($menus);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAll()
    {
        $menus = Menu::where('company_id', Auth::user()->company->id)->get();

        return response()->json($menus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::find($id);

        return response()->json($menu);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $menu = new Menu;
        $menu->company_id = Auth::user()->company->id;
        $menu->period_id = $request->input('period_id'); // The period_id is exsit.
        $menu->name = $request->input('name');
        $menu->save();

        return response()->json([
            'menu_id' => $menu->getAttribute('id'),
            'status' => 0
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);

        if ($menu->period->status == 'visible') {
            return response()->json(['status' => 2]);
        } else {
            $menu->name = $request->input('name');
            $menu->save();
        }

        return response()->json(['status' => 0]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);

        if ($menu->period->status == 'visible') {
            return response()->json(['status' => 2]);
        } else {
            $menu->delete();

            return response()->json(['status' => 0]);
        }
    }
}
