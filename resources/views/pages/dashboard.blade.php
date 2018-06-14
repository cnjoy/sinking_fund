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
				<span class="info-box-text">Total Collection</span>
				<!-- <span class="info-box-number">{{ $available_cash }}</span> -->
				<span class="info-box-number">{{ $available_cash }}</span>
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
				<span class="info-box-number"></span>
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
				<span class="info-box-number thousands">{{ $total_shares * config('constants.amount_per_head') }}</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	
</div>

<div class="row">
	<div class="col-md-9">
		<div class="box box-default">
			<div class="box-header">
				<h3 class="box-title">Summary</h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered">
					<tr>
						<th></th>
						<th>Amount</th>
						<th style="vertical-align : middle;text-align:center;">Total</th>
					</tr>
					<tr>
						<td>Total Collection</td>
						<td>{{ $available_cash }}</td>
						<th rowspan="2" style="vertical-align : middle;text-align:center;">TBD</th>
					</tr>
					<tr>
						<td>Total Interest</td>
						<td class="thousands">1000</td>
					</tr>
					<tr>
						<td>Total Cash On Hand</td>
						<td>TBD</td>
						<th rowspan="2" style="vertical-align : middle;text-align:center;">TBD</th>
					</tr>
					<tr>
						<td>Total Loan Balance</td>
						<td>TBD</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- /.content -->
@stop