@extends('layouts.index')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card stacked-form">
                <div class="card-header ">
                    <h3>Balance: {{$user_balance->balance}}</h3>
                </div>
                <div class="card-body ">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form class="form" method="POST" action="{{ route('orders.store', $date) }}">
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
                                <input type="number" min="0" class="form-control" name="quantity[]"
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
<script>
    var total_quantity = 0;
    var before_get_array_value =  $("input[name='quantity[]']").map(function(){return parseInt($(this).val());}).get();
    before_get_array_value.forEach(myFunction);
    function myFunction(item) {
        total_quantity += item;
    }

    
$('form').submit(function(e) {
    var total_quantity1 = 0;
    var balance = parseInt("{{$user_balance->balance}}");
    var after_get_array_value =  $("input[name='quantity[]']").map(function(){return parseInt($(this).val());}).get();
    after_get_array_value.forEach(myFunction);
    function myFunction(item) {
        total_quantity1 += item;
    }
    var quantity_difference = parseInt(total_quantity) - parseInt(total_quantity1);
    var net_balance = balance + quantity_difference;
    if(net_balance < 0){
        alert("The order exceed the balance.");
        return false;
    }
});
</script>

@endpush