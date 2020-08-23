@extends('Admin.layouts.main_layout')
@section('title', 'صفحه پروفایل')
@section( 'content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">پروفایل</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">پروفایل</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    @include('message')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">پروفایل</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form method="post" role="form">

                            <div class="card-body">
                                <div class="form-group ">
                                    <label for="name">نام:</label>
                                    <input type="text" class="form-control" disabled id="name" name="name" value="{{$profile->name}}">
                                </div>
                                <div class="form-group ">
                                    <label for="email">ایمیل:</label>
                                    <input type="email"  class="form-control" disabled id="email" name="email" value="{{$profile->email}}">

                                </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="{{route('profile.edit',$profile->id)}}"
                                   class="btn btn-primary btn-sm">ویرایش</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

