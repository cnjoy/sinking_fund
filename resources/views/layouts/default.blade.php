<html>
<head>
	@include('includes.head')
</head>
<body class="skin-blue sidebar-mini wysihtml5-supported">
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

	<!-- jQuery -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- App scripts -->
    @stack('scripts')

</body>
</html>