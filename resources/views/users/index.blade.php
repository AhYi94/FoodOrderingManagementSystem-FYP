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

<script>
    $('#user-table').on('click', '.btn-delete', function (e) { 
        if(confirm("Are you sure want to delete?")){
            var token = '{{ csrf_token() }}';
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                }
            });
            var url = $(this).data('id-variable');
            $.ajax({
                url: url,
                type: 'DELETE',
                dataType: 'json',
                data: {method: '_DELETE', submit: true}
            }).always(function (data) {
                $('#user-table').DataTable().draw(false);
            });
        }
    });
</script>
@endpush