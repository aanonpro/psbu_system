@extends('layouts.app')
@section('title', 'Students create')
@section('content')

    <style>
        .form-label{
            color: gray;
        }
    </style>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 " style="text-transform: uppercase;">Create Students</h1>
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
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" name="firstname" placeholder="Enter fistname" autofocus required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" name="lastname" placeholder="Enter lastname" required>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address" placeholder="1234 Main St">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Address 2</label>
                                                <input type="text" class="form-control" name="address2" placeholder="Apartment, studio, or floor">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control" name="city" placeholder="Enter city">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">State</label>
                                                <select class="form-select" name="state" required>
                                                    <option value="" selected>Choose...</option>
                                                    <option value="1">Phnom Penh</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Zip</label>
                                                <input type="text" class="form-control" name="zip" placeholder="Enter zip">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Image</label>
                                                <input type="file" class="form-control">
                                            </div>
                                            <div class="col-12 mt-3">
                                                <button type="submit" class="btn btn-danger float-right">Register Now</button>
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
    </div>

@endsection
