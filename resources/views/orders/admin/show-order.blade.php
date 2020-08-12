@extends('layouts.index')
@section('content')
<div class="content">
    <div class="row">
        {{-- @foreach ($date_orders as $date_order)
        <div class="col-md-3">
            <form class="form" method="POST" action="{{ route('orders.store') }}">
        @csrf
        @method('POST')
        <div class="card ">
            <div class="card-header ">
                <h4 class="card-title text-center">{{$date_order->food->name}}</h4>
                <p class="card-category"></p>
                <img class="img-container" src="/storage/{{$date_order->food->image}}" />
                <input type="number" class="form-control d-none" name="id" value="{{$date_order->food->id}}" />

                <p class="card-category">Quanity</p>
                <input type="number" class="form-control" name="quantity" />
            </div>
            <div class="card-body text-right">
                <button type="submit" class="btn btn-primary btn-wd">Order</a>
            </div>
        </div>
        </form>
    </div>

    @endforeach --}}

    <div class="col-md-12">
        <div class="card stacked-form">
            <div class="card-header ">
            </div>
            <div class="card-body ">
                <form class="form" method="POST" action="{{ route('admin.orders.store',[$user_id, $date]) }}">
                    @csrf
                    @method('POST')
                    <div class="row">
                        @php
                        $i=0
                        @endphp
                        @foreach ($date_orders as $date_order)
                        <div class="form-group col-3">
                            <h4 class="card-title text-center">{{$date_order->food->name}}</h4>
                            <p class="card-category"></p>
                            <img class="img-container" src="/storage/{{$date_order->food->image}}" />
                            <input type="number" class="form-control d-none" name="id[]"
                                value="{{$date_order->food->id}}" />
                            <p class="card-category">Quanity</p>

                            <input type="number" class="form-control" name="quantity[]"
                                value="{{$order_quantity[$i] ?? 0}}" />
                            @php
                            $i++
                            @endphp
                        </div>
                        @endforeach
                    </div>

                    <div class="card-footer ">
                        <button type="submit" class="btn btn-fill btn-info">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>
</div>




@endsection


@push('scripts')


@endpush