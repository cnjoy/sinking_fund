@extends('layouts.default')
@section('subheader_title')
Members
@stop
@section('content')
<div class="table-container">
    <table class="table table-bordered" id="members-table">
        <thead>
            <tr>
                <th>Member (head)</th>
                <th>Amount/mo</th>
                <th>Total Paid</th>
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
        ajax: '/datatables/members',
        columns: [
            { data: 'fullname', name: 'fullname'},
            { data: 'amount', name: 'amount', class:"td-amount"},
            { data: 'total_paid', name: 'total_paid', class:"td-amount"},
            { data: '01/16', name: '01/16', class: 'text-center'},
            { data: '02/01', name: '02/01', class: 'text-center'},
            { data: '02/16', name: '02/16', class: 'text-center'},
            { data: '03/01', name: '03/01', class: 'text-center'},
            { data: '03/16', name: '03/16', class: 'text-center'},
            { data: '04/01', name: '04/01', class: 'text-center'},
            { data: '04/16', name: '04/16', class: 'text-center'},
            { data: '05/01', name: '05/01', class: 'text-center'},
            { data: '05/16', name: '05/16', class: 'text-center'},
            { data: '06/01', name: '06/01', class: 'text-center'},
            { data: '06/16', name: '06/16', class: 'text-center'},
            { data: '07/01', name: '07/01', class: 'text-center'},
            { data: '07/16', name: '07/16', class: 'text-center'},
            { data: '08/01', name: '08/01', class: 'text-center'},
            { data: '08/16', name: '08/16', class: 'text-center'},
            { data: '09/01', name: '09/01', class: 'text-center'},
            { data: '09/16', name: '09/16', class: 'text-center'},
            { data: '10/01', name: '10/01', class: 'text-center'},
            { data: '10/16', name: '10/16', class: 'text-center'},
            { data: '11/01', name: '11/01', class: 'text-center'},
            { data: '11/16', name: '11/16', class: 'text-center'},
            { data: '12/01', name: '12/01', class: 'text-center'},


           
        ]
    });
    $('#members-table').on('click', 'input', function(){
        var checkbox = $(this);
        var row = checkbox.closest('tr');
        var amount  = row.find('.td-amount').text();
        var month_day = checkbox.val();
        var options = {
                        member_id: row.attr('id'), 
                        amount: amount, 
                        month_day: month_day,
                        remove: 0
                    };
        if($(this).is(':checked')){
            $.ajax({
                url: '/update-member-payment',
                type: 'POST',
                data: options,
                success: function(data){

                }
            });
        }else{
            options.remove = 1;
            $.ajax({
                url: '/update-member-payment',
                type: 'POST',
                data: options,
                success: function(data){

                }
            });
        }
    });
});
</script>
@endpush