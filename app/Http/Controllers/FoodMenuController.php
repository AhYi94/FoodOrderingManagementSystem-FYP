<?php

namespace App\Http\Controllers;

use App\DataTables\FoodMenusDataTable;
use App\Models\FoodMenu;
use Carbon\Carbon;
use Carbon\Traits\Timestamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FoodMenusDataTable $dataTable)
    {
        return $dataTable->render('food-menus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('food-menus.create');
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

    /**
     * Display the specified resource.
     *
     * @param  \App\FoodMenu  $foodMenu
     * @return \Illuminate\Http\Response
     */
    public function show(FoodMenu $foodMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FoodMenu  $foodMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(FoodMenu $foodMenu)
    {
        return view('food-menus.edit', compact('foodMenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FoodMenu  $foodMenu
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FoodMenu  $foodMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodMenu $foodMenu)
    {
        //
    }
}
