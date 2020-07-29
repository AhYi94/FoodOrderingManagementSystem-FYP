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
            <input id="datetimepicker" type="text" class="form-control datepicker" name="date"
                placeholder="Date Picker Here" value="{{ old('date',$schedule->date ?? '') }}" />
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <select multiple data-title="Select Food Item" name="fooditem[]" class="selectpicker"
            data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
            @foreach ($fooditems as $fooditem)
            <option value={{$fooditem->id}}>{{$fooditem->name}}</option>
            @endforeach
        </select>
    </div>
</div>