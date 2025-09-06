@extends('backend.partials.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-12 align-items-center">

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div
                            class="info-box mb-3 d-flex justify-content-between align-items-center bg-primary text-white">
                            <div class="info-box-content">
                                <span class="info-box-text fw-bold" style="font-size: 2rem;">My Course</span>
                                <span class="info-box-number" style="font-size: .7rem;">You're making excellent progress in your healthcare training</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Info boxes -->
                <div class="row">
                    <!-- Total Courses Card -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3 d-flex justify-content-between align-items-center">
                            <div class="info-box-content">
                                <span class="info-box-text fw-bold" style="font-size: 1.5rem;">Total Courses</span>
                                <span class="info-box-number text-primary" style="font-size: 2rem;">120</span>
                            </div>
                            <span class="info-box-icon bg-white elevation-1 text-dark">
                                <i class="fas fa-graduation-cap" style="font-size: 2rem;"></i>
                            </span>
                        </div>
                    </div>

                    <!-- In Progress Card -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3 d-flex justify-content-between align-items-center">
                            <div class="info-box-content">
                                <span class="info-box-text fw-bold" style="font-size: 1.5rem;">In Progress</span>
                                <span class="info-box-number text-primary" style="font-size: 2rem;">45</span>
                            </div>
                            <span class="info-box-icon bg-white elevation-1 text-dark">
                                <i class="fas fa-graduation-cap" style="font-size: 2rem;"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Completed Card -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3 d-flex justify-content-between align-items-center">
                            <div class="info-box-content">
                                <span class="info-box-text fw-bold" style="font-size: 1.5rem;">Completed</span>
                                <span class="info-box-number text-primary" style="font-size: 2rem;">75</span>
                            </div>
                            <span class="info-box-icon bg-white elevation-1 text-dark">
                                <i class="fas fa-graduation-cap" style="font-size: 2rem;"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{Auth()->user()->name}} - Dashboard</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-tool dropdown-toggle"
                                            data-toggle="dropdown">
                                        <i class="fas fa-wrench"></i>
                                    </button>

                                </div>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    Welcome To {{Auth()->user()->name}} - Dashboard
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->

                    <!-- /.row -->
                </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
