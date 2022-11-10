<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{url('')}}/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

       @include('layouts.include.navbar')

        @include('layouts.include.sidebar')

        <!-- Content Wrapper. Contains page content -->
       @yield('content')
        <!-- /.content-wrapper -->

        <!-- Main Footer -->

    {{-- footer field --}}

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>

    {{-- vanta js  --}}

    {{-- <script src="{{ asset('vanta/three.r134.min.js')}}"></script>
    <script src="{{ asset('vanta/vanta.dots.min.js')}}"></script>
    <script>
        VANTA.DOTS({
            el: "#vanta_bg",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 1.00
        })
    </script> --}}
</body>

</html>
