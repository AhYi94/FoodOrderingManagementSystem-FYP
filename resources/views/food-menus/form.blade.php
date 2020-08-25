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
    <div class="col-md-12 ">
        <div class="form-group">
            <label for="file">Choose Image File</label>
            <input name="image" type="file" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 ">
        <div class="form-group">
            <label for="name">Food Name</label>
        <input name="name" type="text" class="form-control" value="{{ old('name',$foodMenu->name ?? '') }}">
        </div>
    </div>
</div>