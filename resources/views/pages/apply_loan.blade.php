@extends('layouts.default')
@section('subheader_title')
Apply Loan
@stop
@section('content')
<div class="col-md-6">
	<div class="box box-info ">
	    <div class="box-header with-border">
	      <h3 class="box-title">Application</h3>
	    </div>
		<div class="box-body">
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

			{{  Form::open(array('action'=>'LoansController@add', 'method' => 'post')) }}
			  	<div class="row">
		    		<div class="col-md-12">
			    		<div class="form-group">
			                {{ Form::label('guaranter', 'Guaranter *') }}
				    		{{ Form::select('guaranter', [],  null,array('class' => 'form-control select1')) }}
			      		</div>
			    	</div>
					<div class="col-md-12">
		    			<div class="form-group  div-checkbox">
				    		
				    		{{ Form::checkbox('is_member', '1', false) }}
							{{ Form::label('is_member', 'Is member?') }}
			    		</div>
		    		</div>
		    		<div class="col-md-6">
		    			<div class="form-group">
				    		{{ Form::label('first_name', 'First Name *') }}
				    		{{ Form::text('first_name', '', array('class' => 'form-control')) }}
			    		</div>
		    		</div>
		    		<div class="col-md-6">
		    			<div class="form-group">
				    		<!-- <label>Last Name</label>
				    		<input type="text" class="form-control"/>  -->
				    		{{ Form::label('last_name', 'Last Name *') }}
				    		{{ Form::text('last_name', '', array('class' => 'form-control')) }}
			    		</div>
		    		</div>
					<div class="col-md-6">
		    			<div class="form-group">
				    		{{ Form::label('codename', 'Codename *') }}
				    		{{ Form::text('codename', '', array('class' => 'form-control')) }}
			    		</div>
		    		</div>
					<div class="col-md-6">
		    			<div class="form-group">
				    		{{ Form::label('phone', 'Phone') }}
				    		{{ Form::text('phone', '', array('class' => 'form-control')) }}
			    		</div>
		    		</div>
		    		<div class="col-md-6">
		    			<div class="form-group">
				    		<!-- <label>Amount</label>
				    		<input type="text" class="form-control"/>  -->
				    		{{ Form::label('amount', 'Amount *') }}
				    		{{ Form::text('amount', '0.0', array('class' => 'form-control')) }}
			    		</div>
		    		</div>
					
		    		<div class="col-md-6">
		    			<div class="form-group">
			                {{ Form::label('terms', 'Terms *')}}
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

	$('.div-checkbox [type="checkbox"]').on('change', function(){
		
		if( $(this).is(':checked') ) {
			var member_id = $('#guaranter').val();
			set_name(member_id);
		}
		
	})

	$('#guaranter').on('change', function(){
		
		if( $('.div-checkbox [type="checkbox"]').is(':checked') ) {
			var member_id = $('#guaranter').val();
			set_name(member_id);
		}
		
	})



});

var set_name = function(member_id){
	if($.trim(member_id).length > 0 ) {
		$.get('/members/' + member_id, function(data){
			$('#first_name').val(data.first_name);
			$('#last_name').val(data.last_name);
		});
	}
}

</script>
@endpush