<?php

namespace App\Http\Controllers\Api\AccountingSys;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// System
use Auth;
use Excel;

// Model
use App\Objects\CreationLog;

class CreationLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $creation_logs = CreationLog::all();

        return response()->json($creation_logs);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $creation_log = CreationLog::firstOrNew([
            'timestamp' => $reqeust->input('timestamp'),
            'type' => $request->input('type'),
        ]);

        if ( !$creation_log->isAlterable(Auth::user()) ) {
            return response()->json(['status' => 2]);
        }

        $creation_log->status = 'locked';
        $creation_log->save();
        foreach (json_decode($request->input('fee_logs')) as $fee_log) {
            $creation_log->fee_logs()->save(new FeeLog([
                'user_id' => $fee_log[0],
                'fee' => $fee_log[1],
            ]));
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
        $creation_log = CreationLog::find($id);

        if ( !$creation_log->isAlterable(Auth::user()) ) {
            return response()->json(['status' => 2]);
        }

        $creation_log->delete();

        return response()->json(['status' => 0]);
    }

    /**
     * Export UserAccountingForm with specified <user_id> <array([timestamp, type])>
     *
     * @param \Illumincate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $timestamp = $request->input('timestamp', "201607");
        $period_id = $request->input('period_id', 1);

        Excel::create($timestamp.'津貼報表', function ($excel) use ($timestamp, $period_id) {
            $excel->setTitle($timestamp.'津貼報表');

            $excel->setCreator(Auth::user()->nickname)
                ->setCompany(Auth::user()->company->name);

            $excel->sheet($timestamp.'津貼報表', function ($sheet) use ($timestamp, $period_id) {
                $sheet->rows(CreationLog::genAccountingFormData($timestamp, $period_id));
            });
        })->download('xlsx');
    }

    /**
     * Unlock a specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function unlock($id)
    {
        if ( !Auth::user()->can('unlockReportForm') ) {
            return response()->json(['status' => 2]);
        }

        $creation_log = CreationLog::find($id);
        $creation_log->status = 'unlocked';
        $creation_log->save();

        return response()->json(['status' => 0]);
    }
}
