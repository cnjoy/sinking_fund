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
		<div class="box-body">
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

});


</script>
@endpush