<?php

namespace App\Http\Controllers\Api\AccountSys;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

// Model
use App\Objects\User;
use App\Objects\Company;
use App\Objects\Group;
use App\Objects\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::viewable( Auth::user() )->with(['company', 'group'])->get();

        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Check the role is creatable or not.
        $role = Role::find($request->input('role_id'));
        if ( !Auth::user()->canCreate($role) ) {
            // Change this to 403 in future.
            return response()->json(['status' => 2]);
        }

        // Create user
        $user = new User;

        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->nickname = $request->input('nickname');
        $user->position = $request->input('position');
        $user->company_id = $request->input('company_id');
        $user->group_id = $request->input('group_id');
        $user->save();
        // Need the 職稱/職等

        $user->roles()->save($role);

        return response()->json([
            'user_id' => $user->getAttribute('id'),
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
        $user = User::viewable( Auth::user() )->with(['company', 'group', 'roles'])->where('id', $id)->first();

        return response()->json($user);
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
        // Check the user is alterable or not.
        $user = User::find($id);
        if ( !Auth::user()->canAlter($user) ) {
            return response()->json(['status' => 2]);
        }

        // Update user profile.
        $user->username = $request->input('username');
        $user->nickname = $request->input('nickname');
        $user->position = $request->input('position');
        $user->company_id = $request->input('company_id');
        $user->group_id = $request->input('group_id');
        $user->save();

        return response()->json(['status' => 0]);
    }

    /**
     * Update the role for specified resource
     *
     * @param int $id (user_id)
     * @param int $role_id
     * @return \Illuminate\Http\Response
     */
    public function updateRole($id, $role_id)
    {
        // Check the role is creatable and the user is alterable or not.
        $role = Role::find($role_id);
        $user = User::find($id);
        if ( !Auth::user()->canCreate($role) || !Auth::user()->canAlter($user) ) {
            // Change this to 403 in future.
            return response()->json(['status' => 2]);
        }

        $user->roles()->attach($role);

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
        // Check the user is alterable or not.
        $user = User::find($id);
        if ( !Auth::user()->canAlter($user) ) {
            return response()->json(['status' => 2]);
        }

        $user->delete();

        return response()->json(['status' => 0]);
    }

    /**
     * Remove the role for specified resource
     *
     * @param int $id (user_id)
     * @param int $role_id
     * @return \Illuminate\Http\Response
     */
    public function destroyRole($id, $role_id)
    {
        // Check the role is detachable and the user is alterable or not.
        $role = Role::find($role_id);
        $user = User::find($id);
        if ( !Auth::user()->canCreate($role) || !Auth::user()->canAlter($user) ) {
            // Change this to 403 in future.
            return response()->json(['status' => 2]);
        }

        $user->roles()->detach($role);

        return response()->json(['status' => 0]);
    }
}
