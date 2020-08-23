@extends('Admin.layouts.main_layout')
@section('title', 'صفحه ویرایش پروفایل')
@section( 'content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">ویرایش پروفایل</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">ویرایش پروفایل</li>
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
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">ویرایش پروفایل</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form method="post" action="{{route('profile.update',$profile->id)}}" role="form">
                            @csrf
                            {{method_field('PATCH')}}
                            <div class="card-body">
                                <div class="form-group @if ($errors->has('name')) has-error @endif">
                                    <label for="name">نام:</label>
                                    <input type="text" class="form-control"  id="name" name="name" value="{{$profile->name}}">
                                    <small class="text-danger"
                                           id="email">{{$errors->first('name')}}</small>
                                </div>
                                <div class="form-group @if ($errors->has('email')) has-error @endif ">
                                    <label for="email">ایمیل:</label>
                                    <input type="email"  class="form-control"  id="email" name="email" value="{{$profile->email}}">
                                    <small class="text-danger"
                                           id="email">{{$errors->first('email')}}</small>
                                </div>
                                <div class="form-group @if ($errors->has('password')) has-error @endif ">
                                    <label for="password">پسورد:</label>
                                    <input type="password"  class="form-control" id="password" name="password" value="">
                                    <small class="text-danger"
                                           id="password">{{$errors->first('password')}}</small>
                                </div>
                                <div class="form-group ">
                                    <label for="password_confirmation">تایید پسورد:</label>
                                    <input type="password"  class="form-control"  id="password_confirmation" name="password_confirmation" value="">

                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">بروزرسانی</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

