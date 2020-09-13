<?php

namespace App\Http\Controllers;

use App\DataTables\OrdersDataTable;
use App\Models\FoodMenu;
use App\Models\Order;
use App\Models\Quota;
use App\Models\Schedule;
use App\Models\TopUp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $fooditems = FoodMenu::all();
        $schedule_items = Schedule::orderBy('date')->get()->where('date', '>=', Carbon::now()->addDay()->toDateString())->groupBy('date');
        $user_balance = Quota::where('user_id', Auth::user()->id)->first();
        if (Auth::user()->role == 'user') {
            return view('orders.index', compact('fooditems', 'schedule_items', 'user_balance'));
        } else {
            return abort(404);
        }
    }

    public function indexAdmin(OrdersDataTable $ordersDataTable)
    {
        return $ordersDataTable->render('orders.admin.index');
    }

    public function store(Request $request, $date)
    {

        $rules = [
            'quantity.*' => 'required |integer| gte:0',
        ];

        $customMessages = [
            'required' => 'The quantity field is required.'
        ];

        $this->validate($request, $rules, $customMessages);

        $user_data = Order::where('user_id', Auth::user()->id)->first();
        $get_date = Schedule::where('date', $date)->pluck('id');
        $order_date = Order::whereIn('schedule_date', $get_date)->where('user_id', Auth::user()->id)->get(['schedule_date']);
        $i = 0;
        foreach ($request->quantity as $quantity) {

            if (!is_null($order_date->first()) && $user_data) {
                $order_data = Order::where('user_id', Auth::user()->id)->where('foodmenu_id', $request->id[$i])->whereIn('schedule_date', $get_date);
                $topup_id = Order::where('user_id', Auth::user()->id)->pluck('topup_id');
                $topup_datas = TopUp::where('user_id', Auth::user()->id)->whereIn('id', $topup_id)->whereIn('schedule_id', $get_date)->get();
                $topup_data = TopUp::where('id', $topup_datas[$i]->id);
                $quota_data = Quota::where('user_id', Auth::user()->id)->first();


                $total = $topup_data->first()->amount - $request->quantity[$i];
                $net_total = $quota_data->balance + $total;

                $order_data->update(['quantity' => $request->quantity[$i]]);
                $topup_data->update(['amount' => $request->quantity[$i]]);
                $quota_data->update(['balance' => $net_total]);
            } else {

                $topup_data = new TopUp;
                $topup_data->user_id = Auth::user()->id;
                $topup_data->action = "Consume";
                $topup_data->amount = $request->quantity[$i];
                $topup_data->schedule_id = Schedule::where('date', $date)->pluck('id')[$i];
                $topup_data->save();

                $order_data = new Order();
                $order_data->schedule_date = Schedule::where('date', $date)->pluck('id')[$i];
                $order_data->user_id = Auth::user()->id;
                $order_data->foodmenu_id = $request->id[$i];
                $order_data->quantity = $request->quantity[$i];
                $order_data->topup_id = $topup_data->id;
                $order_data->save();

                $quota_data = Quota::where('user_id', Auth::user()->id)->first();
                $quota_data->balance -= $request->quantity[$i];
                $quota_data->updated_at = Carbon::now();
                $quota_data->save();
            }
            $i++;
        }
        return redirect('orders')->with(['message' => 'Order successful!', 'alert' => 'success']);
    }

    public function show($date)
    {
        $date_orders = Schedule::where('date', $date)->get();
        $date_orders_pluck = Schedule::where('date', $date)->pluck('id');
        $order_quantity = Order::whereIn('schedule_date', $date_orders_pluck)->where('user_id', Auth::user()->id)->pluck('quantity');
        $user_balance = Quota::where('user_id', Auth::user()->id)->first();
        return view('orders.show-order', compact('date_orders', 'date', 'order_quantity', 'user_balance'));
    }

    public function showScheduleAdmin($user_id)
    {
        $fooditems = FoodMenu::all();
        $schedule_items = Schedule::orderBy('date')->get()->where('date', '>=', Carbon::now()->addDay()->toDateString())->groupBy('date');
        return view('orders.admin.show-schedule', compact('fooditems', 'schedule_items', 'user_id'));
    }

    public function showOrderAdmin($user_id, $date)
    {
        $date_orders = Schedule::where('date', $date)->get();
        $date_orders_pluck = Schedule::where('date', $date)->pluck('id');
        $order_quantity = Order::whereIn('schedule_date', $date_orders_pluck)->where('user_id', $user_id)->pluck('quantity');
        $quota_data = Quota::where('user_id', $user_id)->first();
        return view('orders.admin.show-order', compact('date_orders', 'date', 'user_id', 'order_quantity', 'quota_data'));
    }

    public function storeAdmin(Request $request, $user_id, $date)
    {
        $rules = [
            'quantity.*' => 'required |integer| gte:0',
        ];

        $customMessages = [
            'required' => 'The quantity field is required.'
        ];

        $this->validate($request, $rules, $customMessages);

        $user_data = Order::where('user_id', $user_id)->first();
        $get_date = Schedule::where('date', $date)->pluck('id');

        $order_date = Order::whereIn('schedule_date', $get_date)->where('user_id', $user_id)->get(['schedule_date']);
        $i = 0;
        foreach ($request->quantity as $quantity) {

            if (!is_null($order_date->first()) && $user_data) {
                $order_data = Order::where('user_id', $user_id)->where('foodmenu_id', $request->id[$i])->whereIn('schedule_date', $get_date);
                $topup_id = Order::where('user_id', $user_id)->pluck('topup_id');
                $topup_datas = TopUp::where('user_id', $user_id)->whereIn('id', $topup_id)->whereIn('schedule_id', $get_date)->get();
                $topup_data = TopUp::where('id', $topup_datas[$i]->id);
                $quota_data = Quota::where('user_id', $user_id)->first();

                $total = $topup_datas[$i]->amount - $request->quantity[$i];
                $net_total = $quota_data->balance + $total;

                $order_data->update(['quantity' => $request->quantity[$i]]);
                $topup_data->update(['amount' => $request->quantity[$i]]);
                $quota_data->update(['balance' => $net_total]);
            } else {

                $topup_data = new TopUp;
                $topup_data->user_id = $user_id;
                $topup_data->action = "Consume";
                $topup_data->schedule_id = Schedule::where('date', $date)->pluck('id')[$i];
                $topup_data->amount = $request->quantity[$i];
                $topup_data->save();

                $order_data = new Order();
                $order_data->schedule_date = Schedule::where('date', $date)->pluck('id')[$i];
                $order_data->user_id = $user_id;
                $order_data->foodmenu_id = $request->id[$i];
                $order_data->quantity = $request->quantity[$i];
                $order_data->topup_id = $topup_data->id;
                $order_data->save();

                $quota_data = Quota::where('user_id', $user_id)->first();
                $quota_data->balance -= $request->quantity[$i];
                $quota_data->updated_at = Carbon::now();
                $quota_data->save();
            }
            $i++;
        }
        return redirect('/admin/orders')->with(['message' => 'Order successful!', 'alert' => 'success']);
    }
}
