@extends('layouts.index')
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="section-image">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-6">
                        <form class="form" method="POST" action="{{ route('users.store') }}">
                            @csrf
                            @method('POST')
                            <div class="card ">
                                <div class="card-header ">
                                    <div class="card-header">
                                        <h4 class="card-title">Create User</h4>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    @include('users.form')
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Create
                                        User</button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection