@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-md-6 ">
        <div class="form-group">
            <label for="date">Date</label>
            <input id="datetimepicker" type="text" class="form-control datepicker" name="date" placeholder="Date Picker Here"
                value="{{ old('date',$schedule->date ?? '') }}" />
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 ">
        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input id="datetimepicker" class="form-control timepicker" name="start_time" type="text"
                value="{{ old('start_time',$schedule->start_time ?? '') }}">
        </div>
    </div>
    <div class="col-md-6 ">
        <div class="form-group">
            <label for="end_time">End Time</label>
            <input id="datetimepicker" class="form-control timepicker" name="end_time" type="text"
                value="{{ old('end_time',$schedule->end_time ?? '') }}">
        </div>
    </div>

    <div class="col-md-6">
        <select multiple data-title="Select Food Item" name="fooditem[]" class="selectpicker"
            data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
            @foreach (App\Models\FoodMenu::all() as $item)
            <option value={{$item->id}}>{{$item->name}}</option>
            @endforeach
        </select>
    </div>
</div>

{{-- <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>About Me</label>
                    <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description"
                        value="Mike"></textarea>
                </div>
            </div>
        </div> --}}