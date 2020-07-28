@extends('layouts.index')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Striped Table with Hover</h4>
                        <p class="card-category">Here is a subtitle for this table</p>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>No</th>
                                <th>Name</th>
                                <th>Address</th>
                                @foreach ($food_data as $food_name)
                                <th>{{$food_name}}</th>
                                @endforeach

                            </thead>
                            <tbody>
                                {{$order_data}}
                                @foreach($order_data as $order_datas)
                                <tr>
                                    <td>{{$order_datas[0]->user->id}}</td>
                                    <td>{{$order_datas[0]->user->name}}</td>
                                    <td>{{$order_datas[0]->user->address}}</td>
                                    @foreach ($order_datas as $item)
                                    <td>{{$item->quantity}}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                                {{-- <td>{{$order_data[0]->quantity}}</td>
                                <td>{{$order_data[1]->quantity}}</td>
                                <td>{{$order_data[2]->quantity}}</td> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection


@push('scripts')


@endpush