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
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/fixedcolumns/3.2.5/js/dataTables.fixedColumns.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
	<script type="text/javascript" src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>
	
    <!-- Bootstrap JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- App scripts -->
    <script>var editor;</script>
    @stack('scripts')

</body>
</html>