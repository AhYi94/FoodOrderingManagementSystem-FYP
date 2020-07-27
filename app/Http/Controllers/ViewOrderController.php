<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ViewOrderController extends Controller
{
    public function index(){
        $schedule_items = Schedule::orderBy('date')->get()->groupBy('date');
        return view('view-orders.index', compact('schedule_items'));
    }

    public function show($date){
        $user_orders_data = Schedule::where('date' , $date)->pluck('id');
        $orders_data = Order::whereIn('schedule_date', $user_orders_data)->get()->groupBy('user_id');
        
        

        $food_data = Schedule::where('date', $date)->get();
        return view('view-orders.show', compact('orders_data', 'food_data'));
    }
}
