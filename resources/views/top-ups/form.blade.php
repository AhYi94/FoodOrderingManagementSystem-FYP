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
            <label for="amount">Top-Up Amount</label>
            <input class="form-control" type="number" name="amount" number="true" />
        </div>
    </div>
</div>
