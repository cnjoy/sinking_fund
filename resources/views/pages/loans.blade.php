@extends('layouts.default')
@section('subheader_title')
Loans
@stop
@section('content')
<div class="col-md-12">
	<div class="box box-info ">
	    <div class="box-header with-border">
	      <h3 class="box-title">Applicants</h3>
	    </div>
		<div class="box-body" id="">
        <div class="table-container">
                <table class="table table-bordered" id="loan-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Lender (Codename)</th>
                            <!-- <th>c/o</th> -->
                            <th>Loan Amount</th>
                            <th>Terms</th>
                            <!-- <th>Loan Date</th> -->
                            <th>Amortization</th>
                            <th>Amount Paid</th>
                            <th>Balance</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Last Paid</th>
                            
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@stop

@push('scripts')
<link rel="stylesheet" href="js/plugins/bootstrap3-editable/css/bootstrap-editable.css">
<script src="js/plugins/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<script>
$(function() {
    

    var dt = $('#loan-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 50, // default records per page
        ajax: '/datatables/loans',
        columns: [
            {
                "class":          "details-control",
                "orderable":      false,
                "data":           null,
                "defaultContent": ""
            },
            { data: 'lender', name: 'lender'},
            // { data: 'member', name: 'member' },
            { data: 'total_amount', name: 'total_amount' },
            { data: 'months_to_pay', name: 'months_to_pay' },
            { data: 'amount_per_term', name: 'amount_per_term' },
            { data: 'paid', name: 'paid' },
            { data: 'balance', name: 'balance' },
            { data: 'created_at', name: 'created_at' },
            { data: 'end_date', name: 'end_date' },
            { data: 'updated_at', name: 'updated_at' },
            
           
        ]
    });

    $('#loan-table tbody').on( 'click', 'tr td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = dt.row( tr );
        var idx = $.inArray( tr.attr('id'), detailRows );
        var id = tr.attr('id');
 
        if ( row.child.isShown() ) {
            tr.removeClass( 'details' );
            row.child.hide();
 
            // Remove from the 'open' array
            detailRows.splice( idx, 1 );
        }
        else {
            tr.addClass( 'details' );
            row.child( format3( id ) ).show();
            get_details(tr.attr('id'));
          
            // Add to the 'open' array
            if ( idx === -1 ) {
                detailRows.push( tr.attr('id') );
            }
        }
       
       
    } );

    // Array to track the ids of the details displayed rows
    var detailRows = [];
    // On each draw, loop over the `detailRows` array and show any child rows
    dt.on( 'draw', function () {
        $.each( detailRows, function ( i, id ) {
            $('#'+id+' td.details-control').trigger( 'click' );
        } );
    } );
});

function format3 ( id ) {
 
    return `<div class="table-container col-md-4" id="tableDiv_`+id+`">
            </div>`;
}
//turn to inline mode
$.fn.editable.defaults.mode = 'inline';
function get_details(row_id){
    var loan_id = row_id;
    var loan = row_id.split('_');

    if(loan.length > 1) {
        loan_id = loan[1];
    }

    $.ajax({
            "url": '/single-loan/' + loan_id,
            "success": function(json) {

                var trHtml = '';
                $.each(json.data, function(i,data){
                    trHtml += "<tr><td>" + data.month_day + "</td><td>" + '<a href="#" id="date_'+data.month_day+'" class="editable" data-type="text" data-pk="'+loan_id+'" data-url="/update-payment"  data-title="Enter amount">'+ data.amount +'</a>' +"</td></tr>";
                });
                    
                $("#tableDiv_"+row_id).empty();
                $("#tableDiv_"+row_id).append(`<table id="displayTable" class="display table table-bordered" cellspacing="0" width="100%">
                                        <thead><tr><th>Date</th><th>Payment</th></tr></thead>`
                                        + trHtml + 
                                        `</table>`);
                $('.editable').editable();
            },
            "dataType": "json"
        });
}
</script>
@endpush