<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="Joy">
<meta name="csrfToken" content="{{ csrf_token() }}">

<title>Sinking Fund</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.6 -->
<!-- <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css"> -->
<link rel="shortcut icon" href="img/logo.png" />
<link href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
<!-- Font Awesome -->
<link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" >

<!-- Select2 -->
<link href="{{ asset('js/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" >
  <!-- Theme style -->
<!-- Ionicons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('js/plugins/pnotify/pnotify.custom.min.css') }}" rel="stylesheet" type="text/css" >

<script type="text/javascript" src="{{ asset('js/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/pnotify/pnotify.custom.min.js') }}"></script>
<script>
$(function(){
  $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        }
    }); 
})
</script>