<?php

namespace App\Http\Controllers\Api\MenuSys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

// Model
use App\Objects\Period;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periods = Period::all();

        return response()->json($periods);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $period = new Period;
        $period->name = $request->input('name');
        $period->status = $request->input('status'); // visible or invisible
        $period->save();

        return response()->json([
            'period_id' => $period->getAttribute('id'),
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
        $period = Period::find($id);

        $period->name = $request->input('name');
        $period->status = $request->input('status'); // visible or invisible
        $period->save();

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
        Period::find($id)->delete();

        return response()->json(['status' => 0]);
    }
}
