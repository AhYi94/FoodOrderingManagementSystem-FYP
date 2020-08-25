<?php

namespace App\Http\Controllers;

use App\Models\FoodMenu;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fooditems = FoodMenu::all();
        $schedule_items = Schedule::all();
        return view('schedules.create', compact('fooditems', 'schedule_items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'date' => 'required',
            'fooditem' => 'required',
        ]);

        $fooditems = $request->input('fooditem');
        foreach ($fooditems as $fooditem) {
            $schedule_data = new Schedule();
            $schedule_data->date = date('Y-m-d', strtotime($request->input('date')));

            $schedule_data->foodmenu_id = $fooditem;
            $schedule_data->save();
        }
        return redirect('schedules/create')->with(['message' => 'Schedule created!', 'alert' => 'success']);
    }
}
