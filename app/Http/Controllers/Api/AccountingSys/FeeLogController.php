<?php

namespace App\Http\Controllers\Api\AccountingSys;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// Model
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
}
