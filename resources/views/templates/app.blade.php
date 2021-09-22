<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log Aktivitas</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('/adminlte/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('/custom/css/custom.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  
  


  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-light side">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

      @if( Session::get('user')->role == 0 )
      <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ url('/halaman/home')}}" class="nav-link">Home</a>
      </li>
      @endif
      
     <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/semua/{id_dosen}') }}" class="nav-link">History</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->

  @yield('content')

  </div>
  <!-- /.content-wrapper -->

  <!-- Button trigger modal -->

<!-- Modal -->


  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2020 <a href="http://adminlte.io">Log Aktivitas</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/adminlte/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/adminlte/js/demo.js')}}"></script>
<script src="{{ asset('/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{ asset('/plugins/select2/js/select2.full.min.js')}}"></script>


<script type="text/javascript">
  $(function () {
      $('#reservationdate').datetimepicker({
        ignoreReadonly:true
      });
  });
</script>
<script type="text/javascript">
  $(function () {
      $('#fromDate').datetimepicker({
        ignoreReadonly:true,
        format: 'YYYY-MM-DD'
      });
      $('#toDate').datetimepicker({
          ignoreReadonly:true,
          useCurrent: false,
          format: 'YYYY-MM-DD'
      });
      $("#fromDate").on("change.datetimepicker", function (e) {
          $('#toDate').datetimepicker('minDate', e.date);
      });
      $("#toDate").on("change.datetimepicker", function (e) {
          $('#fromDate').datetimepicker('maxDate', e.date);
      });
  });
</script>
</body>
</html>
 