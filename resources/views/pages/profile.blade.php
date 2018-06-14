@extends('layouts.default')
@section('subheader_title')
Profile
@stop
@section('content')
<?php  //pr($userz); 
?>
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

			{{  Form::open(array('action'=>['MembersController@update', $member->id], 'method' => 'post')) }}
			{{ method_field('PATCH') }}
			  	<div class="row">
		    		<div class="col-md-6">
		    			<div class="form-group">
				    		{{ Form::label('first_name', 'First Name *') }}
				    		{{ Form::text('first_name', $member->first_name, array('class' => 'form-control')) }}
			    		</div>
		    		</div>
		    		<div class="col-md-6">
		    			<div class="form-group">
				    		<!-- <label>Last Name</label>
				    		<input type="text" class="form-control"/>  -->
				    		{{ Form::label('last_name', 'Last Name *') }}
				    		{{ Form::text('last_name', $member->last_name, array('class' => 'form-control')) }}
			    		</div>
		    		</div>
					<div class="col-md-6">
		    			<div class="form-group">
				    		{{ Form::label('codename', 'Codename *') }}
				    		{{ Form::text('codename', $member->codename, array('class' => 'form-control')) }}
			    		</div>
		    		</div>
					<div class="col-md-6">
		    			<div class="form-group">
				    		{{ Form::label('email', 'Email') }}
				    		{{ Form::text('email', $member->email, array('class' => 'form-control')) }}
			    		</div>
		    		</div>
					<div class="col-md-6">
		    			<div class="form-group">
				    		{{ Form::label('phone', 'Phone *') }}
				    		{{ Form::text('phone', $member->phone, array('class' => 'form-control')) }}
			    		</div>
		    		</div>
					<div class="col-md-6">
		    			<div class="form-group">
				    		{{ Form::label('amount', 'Amount') }}
				    		{{ Form::text('amount', $member->amount_due, array('class' => 'form-control')) }}
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
            <table class="table table-bordered" id="profile-contribution-table">
                <thead>
                    <tr>
                        <th>Payment date</th>
                        <th>Amount</th>
                    </tr>
                <thead>
            </table>
        </div>
    </div>
    <div class="box box-info ">
	    <div class="box-header with-border">
	      <h3 class="box-title">Loans</h3>
	    </div>
		<div class="box-body">
            <table class="table table-bordered" id="profile-loan-table">
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
var dt = $('#profile-contribution-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 10, // default records per page
        ajax: '/datatables/profile-contribution',
        columns: [
            { data: 'month_day', name: 'month_day' },
            { data: 'amount', name: 'amount' },
        ]
    });
</script>
@endpush