<?php

namespace App\Http\Controllers\Api\MenuSys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

// System
use Auth;

// Model
use App\Objects\UserQuota;
use App\Objects\Product;
use App\Objects\BookingLog;

class BookingLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $booking_log_query = new BookingLog;

        if ($request->has('period_id')) {
            $booking_log_query = $booking_log_query->where('period_id', $request->input('period_id'));
        }

        if ($request->has('user_id')) {
            $booking_log_query = $booking_log_query->where('user_id', $request->input('user_id'));
        }

        $booking_logs = $booking_log_query->get();

        return response()->json($booking_logs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $product = Product::find($request->input('product_id'));

        if ($product->menu->period->status != 'visible') {
            return response()->json(['status' => 2]); // forbidden
        }

        $new_qty = $product->order_qty + $request->input('number');

        if ($new_qty > $peroduct->inventory) {
            return response()->json(['status' => 3]); // Out of inventory.
        }

        $product->order_qty = $new_qty;
        $product->save();
        $new_booking_log = $product->booking_logs()->save(new BookingLog([
            'user_id' => Auth::user()->id,
            'period_id' => $product->menu->period->id,
            'menu_id' => $product->menu->id,
            'product_id' => $product->id,
            'number' => $reqeust->input('number'),
            'price' => $product->price * $request->input('number'),
        ]));

        return response()->json([
            'company_id' => $new_booking_log->getAttribute('id'),
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
        $booking_log = BookingLog::find($id);

        return response()->json($booking_log);
    }

    /**
     * Update the specified resource in storage.
     * PS: Need this function?
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $booking_log = BookingLog::find($id);
        $booking_log->number = $request->input('number');
        $booking_log->price = $booking_log->product->price * $request->input('number');
        $booking_log->save();

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
        BookingLog::find($id)->delete();

        return response()->json(['status' => 0]);
    }

    /**
     * Export the stocking form for a company.
     *
     * @param  \Illuminate\Http\Request  $request -> int period_id {May need menu_id ?}
     * @return \Illuminate\Http\Response
     */
    public function exportStockingForm(Request $request)
    {
        //
    }

    /**
     * Export accounting form with user's company.
     *
     * @param  \Illuminate\Http\Request  $request -> int period_id {May need menu_id ?}
     * @return \Illuminate\Http\Response
     */
    public function exportAccountingForm(Request $request)
    {
        //
    }

    /**
     * Export All the companies' accounting form.
     *
     * @param  \Illuminate\Http\Request  $request -> int period_id
     * @return \Illuminate\Http\Response
     */
    public function exportAllAccountingForm(Request $request)
    {
        //
    }
}
