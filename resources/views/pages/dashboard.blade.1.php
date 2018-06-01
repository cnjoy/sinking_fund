@extends('layouts.default')
@section('subheader_title')
Dashboard
@stop
@section('content')
<!-- Main content -->
<div class="row">
	<!-- /.col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>{{ $deposit }}</h3>
				<p>Your Deposit</p>
			</div>
			<div class="icon">
				<i class="ion ion-bag"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<!-- <h3>{{ $fund_value }}</h3> -->
				<h3>TBD</h3>
				<p>Your Fund Value</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3>{{ $target_savings }}</h3>
				<p>Target Savings</p>
			</div>
			<div class="icon">
				<i class="ion ion-person-add"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<!-- <h3>{{ $expected_amount }}</h3> -->
				<h3>TBD</h3>
				<p>Expected Amount</p>
			</div>
			<div class="icon">
				<i class="ion ion-pie-graph"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
</div>
<!-- Small boxes (Stat box) -->
<div class="row">
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Available Cash</span>
				<!-- <span class="info-box-number">{{ $available_cash }}</span> -->
				<span class="info-box-number">TBD</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Shares</span>
				<span class="info-box-number">{{ $total_shares }}</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-yellow"><i class="fa fa-list-alt"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">No. of Loans</span>
				<span class="info-box-number">{{ $loan_count }}</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-red"><i class="fa fa-ruble "></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Collection/payday</span>
				<span class="info-box-number">{{ $collection_per_payday }}</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	
</div>
<div class="row">
	<div class="col-md-3">
		<!-- Info Boxes Style 2 -->
		<div class="info-box bg-yellow">
			<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Collection</span>
				<span class="info-box-number">{{ $total_collection['amount'] }}</span>
				<div class="progress">
					<div class="progress-bar" style="width: {{ $total_collection['percent'] }}%"></div>
				</div>
				<span class="progress-description">
				{{ $total_collection['percent'] }}% of expected amount
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>
	</div>
	<div class="col-md-3">
		<!-- /.info-box -->
		<div class="info-box bg-red">
			<span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Loans</span>
				<span class="info-box-number">{{ $total_loan['amount'] }}</span>
				<div class="progress">
					<div class="progress-bar" style="width: {{ $total_loan['percent'] }}%"></div>
				</div>
				<span class="progress-description">
				{{ $total_loan['percent'] }}% of collected amount
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>
	</div>
	<div class="col-md-3">	
		<!-- /.info-box -->
		<div class="info-box bg-green">
			<span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Payments</span>
				<span class="info-box-number">{{ $total_payment['amount'] }}</span>
				<div class="progress">
					<div class="progress-bar" style="width: {{ $total_payment['percent'] }}%"></div>
				</div>
				<span class="progress-description">
				{{ $total_payment['percent'] }}% of expected amount
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>
	</div>	

	<div class="col-md-3">	
		<!-- /.info-box -->
		<div class="info-box bg-blue">
			<span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Cash On Hand</span>
				<span class="info-box-number">{{ $total_payment['amount'] }}</span>
				<div class="progress">
					<div class="progress-bar" style="width: {{ $total_payment['percent'] }}%"></div>
				</div>
				<span class="progress-description">
				{{ $total_payment['percent'] }}% of expected amount
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>

		
	</div>
		
		<!-- /.box -->
</div>

<!-- /.row -->

<!-- /.content -->
@stop