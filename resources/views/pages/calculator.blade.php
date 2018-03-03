@extends('layouts.default')
@section('subheader_title')
Calculator
@stop
@section('content')
<div class="col-md-6">
	<div class="box box-info ">
	    <div class="box-header with-border">
	      <h3 class="box-title">Calculator</h3>
	    </div>
		<div class="box-body" id="app">
			{{  Form::open(array('action'=>'LoansController@add', 'method' => 'post')) }}
			  	<div class="row">
		    		
		    		<div class="col-md-6">
		    			<div class="form-group">
				    		<!-- <label>Amount</label>
				    		<input type="text" class="form-control"/>  -->
				    		{{ Form::label('amount', 'Amount') }}
				    		{{ Form::text('amount', '0.0', array('class' => 'form-control')) }}
			    		</div>
		    		</div>
		    		<div class="col-md-6">
		    			<div class="form-group">
				    	<!-- 	<label>Terms</label>
				    		<select class="form-control select2" placeholder="select">
				    			<option>1 month</option>
				    			<option>2 months</option>
				    			<option>3 months</option>
				    			<option>4 months</option>
				    			<option>5 months</option>
				    			<option>6 months</option>
				    			<option>7 months</option>
				    			<option>8 months</option>
				    			<option>9 months</option>
				    			<option>10 months</option>
			                </select> -->
			                {{ Form::label('terms', 'Terms')}}
			                {{ Form::select('terms', array(
			                			'1' => '1 month',
			                			'2' => '2 months',
			                			'3' => '3 months',
			                			'4' => '4 months',
			                			'5' => '5 months',
			                			'6' => '6 months',
			                			'7' => '7 months',
			                			'8' => '8 months',
			                			'9' => '9 months',
			                			'10' => '10 months',
			                		

			                	), null, array('class' => 'form-control'))}}
			    		</div>
		    		</div>
		    		<div class="col-md-6">
		    			<div class="form-group">
		    				<button class="form-control btn-success">Submit</button>
			    		</div>
		    		</div>
			  	</div>
		  	{{  Form::close()  }}  
		</div>
	</div>
</div>
<div class="col-md-6">
	<div class="box box-info ">
	    <div class="box-header with-border">
	      <h3 class="box-title">Computation</h3>
	    </div>
		<div class="box-body" id="app">
			<!-- Payment per payday: Php <span id="calc_result">0.00</span> -->
			<table class="table table-bordered ">
				<tr>
					<td class="tg-yw4l">Loan Amount</td>
					<td class="tg-yw4l">Php <span id="loan_amount">0.00</span></td>
				</tr>
				<tr>
					<td class="tg-yw4l">Months to Pay</td>
					<td class="tg-yw4l"><span id="months_to_pay">0</span></td>
				</tr>
				<tr>
					<td class="tg-yw4l">Interest (5% per month)</td>
					<td class="tg-yw4l">Php <span id="interest">0.00</span></td>
				</tr>
				<tr>
					<td class="tg-yw4l">Total Amount</td>
					<td class="tg-yw4l">Php <span id="total_amount">0.00</span></td>
				</tr>
				<tr>
					<td class="tg-yw4l">Amount per Payday</td>
					<td class="tg-yw4l"><strong  class="text-red">Php <span id="amount_per_payday">0.00</span></strong></td>
				</tr>
				<tr>
					<td class="tg-yw4l"></td>
					<td class="tg-yw4l"></td>
				</tr>
			</table>
		</div>
	</div>
</div>
		
@stop

@push('scripts')
<script src="js/select2/dist/js/select2.full.min.js"></script>
<script>
$(function(){
	//Initialize Select2 Elements
   	$('.select2').select2();

    $('.select1').select2({
		placeholder: 'Select guaranter',
		dataType: 'json',
		ajax: {
			url: '/get_members',
			dataType: 'json'
		},
		
	});

	


	$('#amount').on('keyup', function(){
		var val 	= parseFloat($(this).val());
		var terms 	= $('#terms').val();

		var comp = new Computation(val, terms);
		comp.setComputedValues();
	})
	$('#terms').on('change', function(){
		var val 	= parseFloat($('#amount').val());
		var terms 	= $(this).val();
		
		var comp = new Computation(val, terms);
		comp.setComputedValues();
	})
	

});

function Computation(amount, months){
	this.loan_amount = amount;
	this.months = months;
	this.percentage = 0.5;
	this.interest = 0;
	this.total_amount = 0;
	this.amount_per_payday = 0;
    
	this.spans ={
		'loan_amount' : $('#loan_amount'),
		'months_to_pay' : $('#months_to_pay'),
		'interest' : $('#interest'),
		'total_amount' : $('#total_amount'),
		'amount_per_payday' : $('#amount_per_payday'),
	}

	this.calculate = function(){
		var months = this.months;
		var amount = this.loan_amount;
		var interest = (amount * this.percentage) * months;
		var total_amount = (amount + interest);
		var amount_per_payday = total_amount/(months * 2);
		this.interest = interest;
		this.total_amount = total_amount.toFixed(2);
		this.amount_per_payday = amount_per_payday.toFixed(2);
	}

	this.setComputedValues = function(){
		this.calculate();
		this.spans.loan_amount.text(this.loan_amount).digits();
		this.spans.months_to_pay.text(this.months);
		this.spans.interest.text(this.interest).digits();
		this.spans.total_amount.text(this.total_amount).digits();
		this.spans.amount_per_payday.text(this.amount_per_payday).digits();
	}

}



$.fn.digits = function(){ 
    return this.each(function(){ 
        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
    })
}

function calculate(amount, months){
	var payment = {
		'interest': 0,
		'loan_amount': amount,
		'total_amount': '0.00',
		'amount_per_payday': 0,
	}
	var interest = (amount * 0.05) * months;
	var total_amount = (amount + interest);
	var amount_per_payday = total_amount/(months * 2);

	payment.interest = interest;
	payment.total_amount = total_amount.toFixed(2);
	payment.amount_per_payday = amount_per_payday.toFixed(2);
	
	return payment;


}


</script>
@endpush