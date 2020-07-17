<?php

namespace App\Http\Controllers;

use App\Models\FoodMenu;
use App\Models\Order;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fooditems = FoodMenu::all();
        $schedule_items = Schedule::orderBy('date')->get()->groupBy('date');
        return view('orders.index', compact('fooditems', 'schedule_items'));
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
    public function store(Request $request, $date)
    {
        $i = 0;
        foreach ($request->quantity as $quantity) {
            if ($quantity) {
                $order_data = new Order();
                $order_data->schedule_date = Schedule::where('date', $date)->pluck('id')[$i];
                $order_data->user_id = Auth::user()->id;
                $order_data->foodmenu_id = $request->id[$i];
                $order_data->quantity = $request->quantity[$i];
                $order_data->save();
            } 
            $i++;
        }

        return redirect('orders')->with(['message' => 'Order successful!', 'alert' => 'success']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($date)
    {
        $date_orders = Schedule::where('date', $date)->get();
        return view('orders.show-order', compact('date_orders','date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
