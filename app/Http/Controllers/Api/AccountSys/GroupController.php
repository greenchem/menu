<?php

namespace App\Http\Controllers\Api\AccountSys;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// Model
use App\Objects\Group;
use App\Objects\Company;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::with(['company'])->get();

        return response()->json($groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $group = new Group;
        $group->name = $request->input('name');
        $group->company_id = $request->input('company_id');
        $group->save();

        return response()->json([
            'group_id' => $group->getAttribute('id'),
            'status' => 0
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::find($id);

        return response()->json($group);
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
        Group::where('id', $id)->update([
            'name' => $request->input('name'),
            'company_id' => $request->input('company_id')
        ]);

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
        Group::find($id)->delete();

        return response()->json(['status' => 0]);
    }
}
