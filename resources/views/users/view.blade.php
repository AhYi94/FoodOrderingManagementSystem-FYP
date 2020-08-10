@extends('layouts.index')
@push('styles')
<style>
span.h6 {
    text-transform: none !important;
}
</style>
@endpush
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="section-image">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-6">

                        <div class="card ">
                            <div class="card-header ">
                                <div class="card-header">
                                    <h4 class="card-title">Profile</h4>
                                </div>
                            </div>
                            <div class="card-body mt-3 ml-3">
                                <h5 >Email Address: <span class="h6 text-dark">{{$user_data->email ?? ''}}</span></h5>
                                <h5>Name: <span class="h6 text-dark">{{$user_data->name ?? ''}}</span></h5>
                                <h5>Full Address: <span class="h6 text-dark">{!!$user_data->address." ".$user_data->state." ".$user_data->country." ".$user_data->postal ?? '
                                    <a class="stretched-link" href="'.route("users.edit", Auth::user()->id).'">
                                        <i class="nc-icon nc-simple-add icon-bold"></i> Add
                                    </a>
                                    '!!}</span></h5>
                                    <a class=" btn btn-info btn-fill pull-right" href="{{ route('users.edit', Auth::user()->id) }}">Edit</a>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection