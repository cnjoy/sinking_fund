@extends('layouts.default')
@section('subheader_title')
Members
@stop
@section('content')
<div class="table-container-">
    <table class="table table-bordered " id="members-table" style="width:100%">
        <thead>
            <tr>
                <th>Member (head)</th>
                <th>Monthly Due</th>
                <th>Total Deposit</th>
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

<nav class="optionsMenu" style="z-index:1000; position:fixed">
    <input type="hidden" class="deposit-type">
    <select class="select-deposit-type">
        <option value="Cash">Cash</option>
        <option value="EFT">EFT</option>
    </select>'
</nav>
@stop

@push('scripts')
<script>

$(function() {
    editor = new $.fn.dataTable.Editor( '#members-table' );

    // Activate an inline edit on click of a table cell
    $('#members-table').on( 'click', 'tbody td:not(:first-child)', function (e) {
        editor.inline( this );
    });

    var table = $('#members-table').DataTable({
        scrollY:        "500px",
        scrollX:        true,
        scrollCollapse: true,
        processing: true,
        serverSide: true,
        pageLength: 50, // default records per page
        ajax: '/datatables/members',
        columns: [
            { data: 'fullname', name: 'fullname'},
            { data: 'amount', name: 'amount', class:"td-amount thousands"},
            { data: 'total_paid', name: 'total_paid', class:"thousands total_deposit"},
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
           
        ],
        
        drawCallback: function(){
            separateByThousands();
        },
        fixedColumns:   true,
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        buttons: [
            { extend: "create", editor: editor },
            { extend: "edit",   editor: editor },
            { extend: "remove", editor: editor }
        ]
    });

    

    $('#members-table1').on('click', 'input', function(){
        var checkbox = $(this);
        var row = checkbox.closest('tr');
        var month_day = checkbox.val();
        var options = {
                        row_user_id: row.attr('id'), 
                        month_day: month_day,
                        remove: 0
                    };
                    showOptionsMenu(checkbox);

                    return;
        if($(this).is(':checked')){
            $.ajax({
                url: '/update-member-payment',
                type: 'POST',
                data: options,
                success: function(data){
                    set_message('success', 'Update done');
                    row.children('.total_deposit').text(data.total_paid);
                }
            });
        }else{
            options.remove = 1;
            $.ajax({
                url: '/update-member-payment',
                type: 'POST',
                data: options,
                success: function(data){
                    set_message('success', 'Update done');
                    row.children('.total_deposit').text(data.total_paid);
                }
            });
        }
    });
});

function showOptionsMenu(button) {
    // var songId = $(button).prevAll(".songId").val();
    var menu = $(".optionsMenu");
    var menuWidth = menu.width();
    // menu.find(".songId").val(songId);

    var scrollTop = $(window).scrollTop(); // Distance from top of window to top of document
    var elementOffset = $(button).offset().top; // distance from top of document
    var top = elementOffset -  scrollTop;

    var top = elementOffset - scrollTop;
    var left = $(button).offset().left;

    menu.css({"top" : top + "px", "left" : left - menuWidth + "px", "display" : "inline"});
console.log('click:' + "top"+ top + "px", "left" +( left - menuWidth) + "px");
}
</script>

@endpush

