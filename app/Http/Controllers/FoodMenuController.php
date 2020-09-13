<?php

namespace App\Http\Controllers;

use App\DataTables\FoodMenusDataTable;
use App\Models\FoodMenu;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodMenuController extends Controller
{
    public function index(FoodMenusDataTable $dataTable)
    {
        return $dataTable->render('food-menus.index');
    }

    public function create()
    {
        return view('food-menus.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image',
            'name' => 'required',
        ]);

        $food_data = new FoodMenu();
        $input = $request->all();
        $food_data->fill($input);

        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $file_name = $timestamp.'-'.$request->file('image')->getClientOriginalName();
        $food_data->image = $file_name;
        $request->file('image')->storeAs('public' , $file_name);

        $food_data->save();
        return redirect('food-menus/create')->with(['message' => 'Food Menu created!', 'alert' => 'success']);
    }

    public function edit(FoodMenu $foodMenu)
    {
        return view('food-menus.edit', compact('foodMenu'));
    }

    public function update(Request $request, FoodMenu $foodMenu)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image',
            'name' => 'required',
        ]);

        $food_data = FoodMenu::find($foodMenu->id);
        $input = $request->all();
        $food_data->fill($input);
        if($request->hasFile('image')){
            Storage::delete('public/'.$foodMenu->image);
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $file_name = $timestamp.'-'.$request->file('image')->getClientOriginalName();
            $food_data->image = $file_name;
            $request->file('image')->storeAs('public' , $file_name);
        }
        $food_data->save();
        return redirect('food-menus/' . $food_data->id . '/edit')->with(['message' => 'Food Menu updated!', 'alert' => 'success']);
    }

    public function destroy(FoodMenu $foodMenu)
    {
        $food_data = FoodMenu::find($foodMenu->id);
        $food_data->delete();
        $schedule_data = Schedule::where('foodmenu_id', $foodMenu->id);
        $schedule_data->delete();
    }
}
