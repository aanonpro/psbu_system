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

    {{-- bootstrap  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .form-label{
            color: gray;
        }
    </style>


</head>
<body class="hold-transition sidebar-mini">

    {{-- <div class="content-wrapper"> --}}
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 " style="text-transform: uppercase;">Students Receipt</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        {{-- <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#!">Home</a></li>
                    </ol> --}}
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-10 " style="margin: 0 auto;">
                                        <h4 class="text-center text-primary mb-4" style="text-transform: uppercase;">Students Registration Form</h4>

                                        <form class="row" action="" method="POST" enctype="multipart/form-data">
                                        @csrf
                                            <div class="col-md-6">
                                                <label class="form-label">First Name </label>
                                                <input type="text" class="form-control" value="{{$firstname}}" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Last Name </label>
                                                <input type="text" class="form-control" value="{{ $lastname }}" readonly>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Address </label>
                                                <input type="text" class="form-control" value="{{$address}}" readonly>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Address 2</label>
                                                <input type="text" class="form-control" value="{{$address2}}" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">City </label>
                                                <input type="text" class="form-control" value="{{$city}}" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">State </label>
                                                <input type="text" class="form-control" value="{{$state}}" readonly>

                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Zip </label>
                                                <input type="text" class="form-control" value="{{$zip}}" readonly>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Image</label>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div><!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    {{-- </div> --}}
 <!-- jQuery -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
    {{-- bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
