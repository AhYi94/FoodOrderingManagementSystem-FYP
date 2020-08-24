@extends('layouts.index')
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">View Order</h4>
                    </div>
                    <div id="section-to-print">
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>No</th>
                                    <th>Food</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach($order_data as $order_datas)
                                    <tr>
                                        @if ($order_datas->quantity > 0)
                                        <td>{{$i++}}</td>
                                        <td>{{$order_datas->food->name}}</td>
                                        <td>{{$order_datas->quantity}}</td>
                                        <td>{{$order_datas->schedule->date}}</td>
                                        @endif
                                        </td>
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
</div>

@endsection

@push('scripts')
<script>
    document.querySelector("#printarea").addEventListener("click", function() {
	window.print();
});
</script>
@endpush