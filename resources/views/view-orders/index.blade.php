@extends('layouts.index')
@section('content')
<div class="content">
    <div class="row">
        @foreach ($schedule_items as $fooditem)
        <div class="col-md-2">
            <a href="{{route('view-orders.show', $fooditem[0]->date)}}">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">{{date_format(date_create($fooditem[0]->date), 'l')}}</h4>
                        <p class="card-category">{{$fooditem[0]->date}}</p>
                    </div>
                    <div class="card-body ">
                        <div></div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>




@endsection


@push('scripts')


@endpush