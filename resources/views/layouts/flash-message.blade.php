<style>
    [data-notify="progressbar"] {
        margin-bottom: 0px;
        position: absolute;
        bottom: 0px;
        left: 0px;
        width: 100%;
        height: 5px;
    }
</style>

@push('scripts')
<script>
    @if(session()->has('message'))
    $.notify({
	message: '{{ session('message') }}'
},{
	type: '{{session("alert")?? "alert-info"}}'
});
@endif
</script>
@endpush