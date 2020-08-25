@extends('layouts.index')
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="section-image">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-6">
                        <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('food-menus.update', $foodMenu->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card ">
                                <div class="card-header ">
                                    <div class="card-header">
                                        <h4 class="card-title">Edit Food Menu</h4>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    @include('food-menus.form')
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>
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