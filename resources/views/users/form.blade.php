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
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="Email" value="{{ old('email',$user->email ?? '') }}">
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Password</label>
            <input name="password" type="password" class="form-control" placeholder="Password" value="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Confirm Password</label>
            <input name="password_confirmation" type="password" class="form-control" placeholder="Password" value="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Name</label>
            <input name="name" type="text" class="form-control" placeholder="Full Name" value="{{$user->name ?? ''}}">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Address</label>
            <input name="address" type="text" class="form-control" placeholder="Home Address"
                value="{{$user->address ?? ''}}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 pr-1">
        <div class="form-group">
            <label>City</label>
            <input name="city" type="text" class="form-control" placeholder="City" value="{{$user->city ?? ''}}">
        </div>
    </div>
    <div class="col-md-4 px-1">
        <div class="form-group">
            <label>Country</label>
            <input name="country" type="text" class="form-control" placeholder="Country"
                value="{{$user->country ?? ''}}">
        </div>
    </div>
    <div class="col-md-4 pl-1">
        <div class="form-group">
            <label>Postal Code</label>
            <input name="postal" type="number" class="form-control" placeholder="ZIP Code"
                value="{{$user->postal ?? ''}}">
        </div>
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