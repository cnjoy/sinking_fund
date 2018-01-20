@extends('layouts.default')
@section('subheader_title')
Members
@stop
@section('content')
<table class="table table-bordered" id="members-table">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Shares</th>
            <th>Amount</th>
            
        </tr>
    </thead>
</table>
@stop

@push('scripts')
<script>
$(function() {
    $('#members-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/datatables/members',
        columns: [
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'shares', name: 'shares' },
            { data: 'amount', name: 'amount' },
           
        ]
    });
});
</script>
@endpush