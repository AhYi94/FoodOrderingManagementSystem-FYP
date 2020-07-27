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
                                    <th>{{$food_name->food->name}}</th>
                                @endforeach
                            </thead>
                            <tbody>
                                {{-- Group by : 1, 12 collection --}}
                                {{-- $user_id_index get user_id --}}
                                {{-- user_id_value collection of user_id--}}
                                @foreach ($orders_data as $user_id_index => $user_id_value)
                                {{$user_id_value}}
                                    <tr>
                                        @if ($user_id_index)
                                            @php
                                                $user = \App\Models\User::find($user_id_index)
                                            @endphp
                                                <td>{{$user->id}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->address}}</td>

                                            {{-- $user_id_value get Order id --}}
                                            @foreach ($user_id_value as $index)
                                            
                                                @foreach ($food_data as $value)
                                                
                                                    @if ($index->foodmenu_id == $value->foodmenu_id)
                                                        <td>{{$index->quantity}}</td>
                                                    @elseif($value->quantity == 0)
                                                    <td>0</td>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif
                                        {{-- <td>{{$users->user->id}}</td> --}}
                                        {{-- <td>{{$users->user->address . " " .$users->user->city}}</td> --}}
                                        {{-- <td>{{$users->foodmenu_id}}</td> --}}
                                    </tr>
                                @endforeach

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