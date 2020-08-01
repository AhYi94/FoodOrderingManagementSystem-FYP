@extends('layouts.index')
@section('content')

<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .navbar, .card-header, .card-title, #printarea {
            display: none;
        }

        #section-to-print {
            width: 100%;
        }

        #section-to-print,
        #section-to-print * {
            visibility: visible;
            color: black;
            overflow-x: hidden;
        }

        #section-to-print {
            position: absolute;
            left: 0;
            top: 0;
        }

        tr:nth-child(odd) td {
            background-color: rgba(0, 0, 0, .05) !important;
            -webkit-print-color-adjust: exact;
        }
    }
</style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <button id="printarea" class="btn btn-secondary buttons-print">
                    <span>
                        <i class="fa fa-print"></i> Print
                    </span>
                </button>

                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">View Order</h4>
                    </div>
                    <div id="section-to-print">
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
                                    @foreach($order_data as $order_datas)
                                    <tr>
                                        <td>{{$order_datas[0]->user->id}}</td>
                                        <td>{{$order_datas[0]->user->name}}</td>
                                        <td>{{$order_datas[0]->user->address.' '.$order_datas[0]->user->city.' '.$order_datas[0]->user->postal }}
                                        </td>
                                        @foreach ($order_datas as $item)
                                        <td>{{$item->quantity}}</td>
                                        @endforeach
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