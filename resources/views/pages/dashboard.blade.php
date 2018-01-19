@extends('layouts.default')
@section('subheader_title')
Dashboard
@stop
@section('content')
<!-- Main content -->
<!-- Small boxes (Stat box) -->
<div class="row">
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Available Cash</span>
				<span class="info-box-number">1,410</span>
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
				<span class="info-box-number">410</span>
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
				<span class="info-box-number">1</span>
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
				<span class="info-box-number">27,000</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>500.00</h3>
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
				<h3>505.00</h3>
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
				<h3>11,000</h3>
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
				<h3>11,505</h3>
				<p>Expected Amount</p>
			</div>
			<div class="icon">
				<i class="ion ion-pie-graph"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<!-- Info Boxes Style 2 -->
		<div class="info-box bg-yellow">
			<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Collection</span>
				<span class="info-box-number">15,200</span>
				<div class="progress">
					<div class="progress-bar" style="width: 50%"></div>
				</div>
				<span class="progress-description">
				100% of expected amount
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>

		<!-- /.info-box -->
		<div class="info-box bg-red">
			<span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Loans</span>
				<span class="info-box-number">15,000</span>
				<div class="progress">
					<div class="progress-bar" style="width: 90%"></div>
				</div>
				<span class="progress-description">
				90% of collected amount
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		
		<!-- /.info-box -->
		<div class="info-box bg-green">
			<span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Payments</span>
				<span class="info-box-number">1,000</span>
				<div class="progress">
					<div class="progress-bar" style="width: 20%"></div>
				</div>
				<span class="progress-description">
				10% of expected amount
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>

		
		
		
		<!-- /.box -->
	</div>
	<div class="col-md-8">
	<!-- PRODUCT LIST -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Recent Activities</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<ul class="products-list product-list-in-box">
					<li class="item">
						<div class="product-img">
							<img src="img/default-50x50.gif" alt="Product Image">
						</div>
						<div class="product-info">
							<a href="javascript:void(0)" class="product-title">Cielito Joy Neri
							<span class="label label-warning pull-right">Php 500.00</span></a>
							<span class="product-description">
							Made a contribution for January 16th
							</span>
						</div>
					</li>
					<!-- /.item -->
					<li class="item">
						<div class="product-img">
							<img src="img/default-50x50.gif" alt="Product Image">
						</div>
						<div class="product-info">
							<a href="javascript:void(0)" class="product-title">Ann Heradura
							<span class="label label-warning pull-right">Php 1500.00</span></a>
							<span class="product-description">
							Made a contribution for January 16th
							</span>
						</div>
					</li>
					<!-- /.item -->
					<li class="item">
						<div class="product-img">
							<img src="img/default-50x50.gif" alt="Product Image">
						</div>
						<div class="product-info">
							<a href="javascript:void(0)" class="product-title">Sam Heradura <span class="label label-danger pull-right">Php 3500.00</span></a>
							<span class="product-description">
							Applied loan
							</span>
						</div>
					</li>
					<!-- /.item -->
					<li class="item">
						<div class="product-img">
							<img src="img/default-50x50.gif" alt="Product Image">
						</div>
						<div class="product-info">
							<a href="javascript:void(0)" class="product-title">PlayStation 4
							<span class="label label-success pull-right">$399</span></a>
							<span class="product-description">
							Made a payment
							</span>
						</div>
					</li>
					<!-- /.item -->
				</ul>
			</div>
			<!-- /.box-body -->
			<div class="box-footer text-center">
				<a href="javascript:void(0)" class="uppercase">View All Products</a>
			</div>
			<!-- /.box-footer -->
		</div></div>
	<!-- ./col -->
</div>
<!-- /.row -->

<!-- /.content -->
@stop