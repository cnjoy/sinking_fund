<html>
<head>
	@include('includes.head')
</head>
<body>
	<div class="wrapper">
		<header class="main-header">
			@include('includes.header')
		</header>
		<aside class="main-sidebar">
			<!-- Content Header (Page header) -->
			@include('includes.sidebar')
		</aside>
		<div class="content-wrapper">
	  		<section class="content-header">
			  	@include('includes.subheader')
			</section>
			<section class="content">
	  			@yield('content')
	  		</section>
	  	</div>
		
		<footer class="row">
	        @include('includes.footer')
	    </footer>
	 </div>
</body>
</html>