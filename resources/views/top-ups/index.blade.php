@extends('layouts.index')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="section-image" data-image="/assets/img/bg5.jpg" ;>
            <div class="container">
                {{$dataTable->table()}}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

{{$dataTable->scripts()}}

@endpush