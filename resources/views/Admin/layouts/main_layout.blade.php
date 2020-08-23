<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href={{asset("/admin/plugins/font-awesome/css/font-awesome.min.css")}}>
  <!-- Ionicons -->
  <link rel="stylesheet" href={{asset("https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css")}}>

  <link rel="stylesheet" href={{asset("/admin/dist/css/adminlte.min.css")}}>

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- bootstrap rtl -->
  <link rel="stylesheet" href={{asset("/admin/dist/css/bootstrap-rtl.min.css")}}>
  <!-- template rtl version -->
  <link rel="stylesheet" href={{asset("/admin/dist/css/custom-style.css")}}>
  @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
    @include('Admin.layouts.partials.nav')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
   @include('Admin.layouts.partials.sidebar')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
     @yield('content')

    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
  @include('Admin.layouts.partials.footer')


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src={{asset("/admin/plugins/jquery/jquery.min.js")}}></script>


<script src={{asset("/admin/plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>

<script src={{asset("https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js")}}></script>

<script src={{asset("https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js")}}></script>

<script src={{asset("/admin/dist/js/adminlte.js")}}></script>

@yield('script')
</body>
</html>
