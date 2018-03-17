<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="Joy">
<meta name="csrfToken" content="{{ csrf_token() }}">

<title>Joy Neri</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="js/select2/dist/css/select2.min.css">
  <!-- Theme style -->
<!-- Ionicons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="css/AdminLTE.min.css">
<link rel="stylesheet" href="css/skins/_all-skins.min.css">
<link rel="stylesheet" href="css/style.css">

<script src="js/jquery/dist/jquery.min.js"></script>
<!-- <script src="js/plugins/jquery.numeric-only.js"></script> -->

<script>
$(function(){
  $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        }
    }); 
})
</script>