<?php

namespace App\Http\Controllers;

use App\DataTables\QuotasDataTable;
use App\Models\Quota;
use App\Models\TopUp;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TopUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QuotasDataTable $dataTable)
    {

        return $dataTable->render('top-ups.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('top-ups.create', compact('id'));
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
        $topup_data = new TopUp;
        $topup_data->user_id = $id;
        $topup_data->action = "Top-Up";
        $topup_data->amount = $request->amount;
        $topup_data->save();

        $quota_data = Quota::where('user_id', $id)->first();
        $quota_data->balance += $request->amount;
        $quota_data->updated_at = Carbon::now();
        $quota_data->save();

        return redirect('/top-ups')->with(['message' => 'Order successful!', 'alert' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
