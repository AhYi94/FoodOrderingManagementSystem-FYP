@extends('layouts.index')
@section('content')
<div class="content">
    <div class="row">
        @foreach ($date_orders as $date_order)
        <div class="col-md-3">

            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title text-center">{{$date_order->food->name}}</h4>
                    <p class="card-category"></p>
                    <img class="img-container" src="/storage/{{$date_order->food->image}}" />
                </div>
                <div class="card-body ">
                    <div></div>
                </div>
            </div>

        </div>

        @endforeach

    </div>
</div>




@endsection


@push('scripts')


@endpush