<?php

namespace App\Http\Controllers\Api\AccountingSys;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// System
use Auth;

// Model
use App\Objects\CreationLog;
use App\Objects\FeeLog;

class FeeLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fee_logs = FeeLog::where('creation_log_id', $request->input('creation_log_id'))->get();

        return response()->json($fee_logs);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $creation_log = CreationLog::find($request->input('creation_log_id'));

        if ( !$creation_log->isAlterable(Auth::user()) ) {
            return response()->json(['status' => 2]);
        }

        $creation_log->fee_logs()->delete();

        return response()->json(['status' => 0]);
    }
}
