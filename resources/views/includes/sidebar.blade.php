
<section class="sidebar">
	<!-- Sidebar user panel -->
	<div class="user-panel">
		<div class="pull-left image">
		  	<img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
			  
		</div>
		<div class="pull-left info">
		  	<p>{{Auth::user()->member->first_name}} {{Auth::user()->member->last_name}}</p>
		  	<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
		</div>
	</div>

	<ul class="sidebar-menu">
		<li class="header">MAIN NAVIGATION</li>
		<li class="dashboard">
			<a href="/dashboard">
	            <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
          	<!-- <ul class="treeview-menu">
	            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
	            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          	</ul> -->
		</li>
		<li class="">
			<a href="/members">
	            <i class="fa fa-users"></i> <span>Members</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
        </li>
        <!-- <li class="">
			<a href="/loans">
	            <i class="fa fa-credit-card"></i> <span>Loans</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
        </li> -->
        <!-- <li class="">
			<a href="/forecast">
	            <i class="fa fa-area-chart"></i> <span>Forecast</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
        </li> -->
        <li class="header">ACTION</li>
        <li><a href="#"><i class="fa fa-file-pdf-o text-red"></i> <span>Agreement</span></a></li>
        <li><a href="/calculator"><i class="fa fa-calculator text-yellow"></i> <span>Calculator</span></a></li>
        <li><a href="/apply-loan"><i class="fa fa-cart-plus text-aqua"></i> <span>Appy Loan</span></a></li>
	</ul>
</section>
