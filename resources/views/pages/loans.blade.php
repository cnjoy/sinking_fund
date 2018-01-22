@extends('layouts.default')
@section('subheader_title')
Loans
@stop
@section('content')
<div class="table-container">
    <table class="table table-bordered" id="members-table">
        <thead>
            <tr>
                <th>Lenders (terms) </th>
                <th>c/o</th>
                <th>Amount</th>
                <th>Paid</th>
                <th>01/16</th>
                <th>02/01</th>
                <th>02/16</th>
                <th>03/01</th>
                <th>03/16</th>
                <th>04/01</th>
                <th>04/16</th>
                <th>05/01</th>
                <th>05/16</th>
                <th>06/01</th>
                <th>06/16</th>
                <th>07/01</th>
                <th>07/16</th>
                <th>08/01</th>
                <th>08/16</th>
                <th>09/01</th>
                <th>09/16</th>
                <th>10/01</th>
                <th>10/16</th>
                <th>11/01</th>
                <th>11/16</th>
                <th>12/01</th>


                
            </tr>
        </thead>
    </table>
</div>
@stop

@push('scripts')
<script>
$(function() {
    $('#members-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 50, // default records per page
        ajax: '/datatables/loans',
        columns: [
            { data: 'fullname', name: 'fullname'},
            { data: 'member', name: 'member' },
            { data: 'total_amount', name: 'total_amount' },
            { data: 'amount_paid', name: 'amount_paid' },
            { data: 'January 16', name: 'January 16', class: 'text-center'},
            { data: 'February 1', name: 'February 1', class: 'text-center'},
            { data: 'February 16', name: 'February 16', class: 'text-center'},
            { data: 'March 1', name: 'March 1', class: 'text-center'},
            { data: 'March 16', name: 'March 16', class: 'text-center'},
            { data: 'April 1', name: 'April 1', class: 'text-center'},
            { data: 'April 16', name: 'April 16', class: 'text-center'},
            { data: 'May 1', name: 'May 1', class: 'text-center'},
            { data: 'May 16', name: 'May 16', class: 'text-center'},
            { data: 'June 1', name: 'June 1', class: 'text-center'},
            { data: 'June 16', name: 'June 16', class: 'text-center'},
            { data: 'July 1', name: 'July 1', class: 'text-center'},
            { data: 'July 16', name: 'July 16', class: 'text-center'},
            { data: 'August 1', name: 'August 1', class: 'text-center'},
            { data: 'August 16', name: 'August 16', class: 'text-center'},
            { data: 'September 1', name: 'September 1', class: 'text-center'},
            { data: 'September 16', name: 'September 16', class: 'text-center'},
            { data: 'October 1', name: 'October 1', class: 'text-center'},
            { data: 'October 16', name: 'October 16', class: 'text-center'},
            { data: 'November 1', name: 'November 1', class: 'text-center'},
            { data: 'November 16', name: 'November 16', class: 'text-center'},
            { data: 'December 1', name: 'December 1', class: 'text-center'},

           
        ]
    });
});
</script>
@endpush