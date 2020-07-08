@extends('layouts.index')
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="section-image">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-6">
                        <form class="form" method="POST"
                            action="{{ route('schedules.store') }}">
                            @csrf
                            @method('POST')
                            <div class="card ">
                                <div class="card-header ">
                                    <div class="card-header">
                                        <h4 class="card-title">Create Ordering Schedule</h4>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    @include('schedules.form')
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Create
                                        Schedule</button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                {{-- <div class="col-md-4">
                    <div class="card card-user">
                        <div class="card-header no-padding">
                            <div class="card-image">
                                <img src="../../assets/img/full-screen-image-3.jpg" alt="...">
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="author">
                                <a href="#">
                                    <img class="avatar border-gray" src="../../assets/img/default-avatar.png" alt="...">
                                    <h5 class="card-title">Tania Keatley</h5>
                                </a>
                                <p class="card-description">
                                    michael24
                                </p>
                            </div>
                            <p class="card-description text-center">
                                Hey there! As you can see,
                                <br> it is already looking great.
                            </p>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="button-container text-center">
                                <button href="#" class="btn btn-simple btn-link btn-icon">
                                    <i class="fa fa-facebook-square"></i>
                                </button>
                                <button href="#" class="btn btn-simple btn-link btn-icon">
                                    <i class="fa fa-twitter"></i>
                                </button>
                                <button href="#" class="btn btn-simple btn-link btn-icon">
                                    <i class="fa fa-google-plus-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
</div>
@endsection