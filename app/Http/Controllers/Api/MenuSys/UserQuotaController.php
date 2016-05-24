<?php

namespace App\Http\Controllers\Api\MenuSys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

// Model
use App\Objects\UserQuota;

class UserQuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$user_quotas = UserQuota::where('period_id', $request->input('period_id'))->get();
        $user_quotas = UserQuota::all();

        return response()->json($user_quotas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_quota = new UserQuota;
        $user_quota->user_id = $request->input('user_id');
        $user_quota->period_id = $request->input('period_id');
        $user_quota->quota = $request->input('quota');
        $user_quota->save();

        return response()->json([
            'user_quota_id' => $user_quota->getAttribute('id'),
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
        $user_quota = UserQuota::find($id);

        $user_quota->quota = $request->input('quota');
        $user_quota->save();

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
        UserQuota::find($id)->delete();

        return response()->json(['status' => 0]);
    }
}
