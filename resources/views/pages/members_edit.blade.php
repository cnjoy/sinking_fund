@extends('layouts.default')
@section('subheader_title')
Profile
@stop
@section('content')
<div class="col-md-6">
	<div class="box box-info ">
	    <div class="box-header with-border">
	      <h3 class="box-title">Profile</h3>
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

			{{  Form::open(array('action'=>['LoansController@update', $id], 'method' => 'post')) }}
			{{ method_field('PATCH') }}
			  	<div class="row">
                  <div class="col-md-12">
		    			<div class="form-group  div-checkbox">
				    		
				    		{{ Form::checkbox('is_member', '1', $is_member) }}
							{{ Form::label('is_member', 'Is member?') }}
			    		</div>
		    		</div>
		    		<div class="col-md-6">
		    			<div class="form-group">
				    		{{ Form::label('first_name', 'First Name *') }}
				    		{{ Form::text('first_name', $first_name, array('class' => 'form-control')) }}
			    		</div>
		    		</div>
		    		<div class="col-md-6">
		    			<div class="form-group">
				    		<!-- <label>Last Name</label>
				    		<input type="text" class="form-control"/>  -->
				    		{{ Form::label('last_name', 'Last Name *') }}
				    		{{ Form::text('last_name', $last_name, array('class' => 'form-control')) }}
			    		</div>
		    		</div>
					<div class="col-md-6">
		    			<div class="form-group">
				    		{{ Form::label('codename', 'Codename *') }}
				    		{{ Form::text('codename', $codename, array('class' => 'form-control')) }}
			    		</div>
		    		</div>
					<div class="col-md-6">
		    			<div class="form-group">
				    		{{ Form::label('email', 'Email') }}
				    		{{ Form::text('email', $email, array('class' => 'form-control')) }}
			    		</div>
		    		</div>
					<div class="col-md-6">
		    			<div class="form-group">
				    		{{ Form::label('phone', 'Phone *') }}
				    		{{ Form::text('phone', $phone, array('class' => 'form-control')) }}
			    		</div>
		    		</div>
					<div class="col-md-6">
		    			<div class="form-group">
				    		{{ Form::label('amount', 'Amount') }}
				    		{{ Form::text('amount', $amount, array('class' => 'form-control')) }}
			    		</div>
		    		</div>

		    		<div class="col-md-6">
		    			<div class="form-group">
		    				<button class="form-control btn-success">Update</button>
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
	      <h3 class="box-title">Contribution</h3>
	    </div>
		<div class="box-body">
            <table class="table table-bordered" id="lender-payment-table">
                <thead>
                    <tr>
                        <th>Payment date</th>
                        <th>Amount</th>
                    </tr>
                <thead>
            </table>
        </div>
    </div>
   
</div>

@stop

@push('scripts')
<script>
var dt = $('#lender-payment-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 10, // default records per page
        ajax: '/single-loan/{{$id}}',
        columns: [
            { data: 'month_day', name: 'month_day' },
            { data: 'amount', name: 'amount' },
        ]
    });
</script>
@endpush