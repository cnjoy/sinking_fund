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
                            <th>c/o</th>
                            <th>Loan Amount</th>
                            <th>Terms</th>
                            <!-- <th>Loan Date</th> -->
                            <th>Amortization</th>
                            <th>Amount Paid</th>
                            <th>Balance</th>
                            <th>Start Date</th>
                            <th>Last Paid</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
	<div class="box box-info ">
	    <div class="box-header with-border">
	      <h3 class="box-title">Loans</h3>
	    </div>
        <div class="box-body" id="">
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
        </div>
   </div>
</div>
@stop

@push('scripts')
<link rel="stylesheet" href="js/plugins/bootstrap3-editable/css/bootstrap-editable.css">
<script src="js/plugins/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<script>
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        }
    }); 
    $('#members-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 50, // default records per page
        ajax: '/datatables/lenders',
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
            { data: 'member', name: 'member' },
            { data: 'total_amount', name: 'total_amount' },
            { data: 'months_to_pay', name: 'months_to_pay' },
            { data: 'amount_per_term', name: 'amount_per_term' },
            { data: 'paid', name: 'paid' },
            { data: 'balance', name: 'balance' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'end_date', name: 'end_date' },
           
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
                    trHtml += "<tr><td>" + data.month_day + "</td><td>" + '<a href="#" id="date_'+data.pdid+'" class="editable" data-type="text" data-pk="'+loan_id+'" data-url="/update-payment"  data-title="Enter amount">'+ data.amount +'</a>' +"</td></tr>";
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