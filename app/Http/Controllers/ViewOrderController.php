<?php

namespace App\Http\Controllers;

use App\Models\FoodMenu;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\User;
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
        $schedule = Schedule::where('date', $date)->get();


        //Food Name by Date
        $schedule_id_byDate = Schedule::where('date', $date)->pluck('foodmenu_id');
        $food_data = FoodMenu::whereIn('id', $schedule_id_byDate)->pluck('name');

        $order_userId = Order::all()->pluck('user_id')->unique();
        $abc = array_values($order_userId->toArray());     
        
        $order_foodmenuId = Order::all()->pluck('foodmenu_id')->unique();
        $order_userId = Order::all()->pluck('user_id')->unique();

        $get_foodmenu_id_by_date = Order::whereIn('orders.foodmenu_id', $order_foodmenuId)
        ->pluck('foodmenu_id')->unique();

        $get_user_id_by_date = Order::whereIn('orders.user_id', $order_userId)
        ->pluck('user_id')->unique();

        $order_data = Order::join('schedules', 'orders.schedule_date', '=', 'schedules.id')
        ->select('orders.*', 'schedules.date')
        ->whereIn('orders.user_id', $get_user_id_by_date)
        ->whereIn('orders.foodmenu_id', $get_foodmenu_id_by_date)
        ->where('schedules.date' ,'=' ,$date)
        ->get()->groupBy('user_id');

        // return $order_data;

// foreach ($order_data as $order_datas) {
//     return $abc[] = $order_datas;
// }


        // $order_data = Order::join('schedules', 'orders.schedule_date', '=', 'schedules.id')
        // ->select('orders.*', 'schedules.date')
        // ->where('orders.user_id', 1)
        // ->where('orders.foodmenu_id', 1)
        // ->where('schedules.date' ,'=' ,$date)
        // ->get();
        // return $order_data;

        // $order_data = \DB::table('orders')->join('schedules', 'orders.schedule_date', '=', 'schedules.id')->select('orders.*', 'schedules.date')->where('orders.user_id', '1')->where('orders.foodmenu_id', '2')->where('schedules.date' , $date)->sum('quantity');
        // return  $order_data;
        // foreach($order_user_id as $items){
        //     return $items->quantity;
        // }


        
        // $order_foodmenu_id = Order::where('foodmenu_id', $food_id)->where('schedule_date', )->get();
        // return $order_foodmenu_id;
        // $schedule_foodMenuId_by_date;
        // $order_foodMenuId_By_schedule_date;

        return view('view-orders.show', compact('orders_data', 'schedule', 'date', 'food_data', 'order_data', 'get_user_id_by_date', 'get_foodmenu_id_by_date'));
    }
}
