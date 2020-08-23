@extends('Admin.layouts.main_layout')
@section('title', 'صفحه ویرایش درس')
@section( 'content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">ویرایش درس</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">ویرایش درس</li>
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
                            <h3 class="card-title">ویرایش درس</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{route('lessons.update',$lesson->id)}}" role="form">
                            @csrf
                            {{method_field('PATCH')}}
                            <div class="card-body">
                                <div class="form-group @if ($errors->has('name')) has-error @endif">
                                    <label for="name">نام درس</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$lesson->name}}"
                                           placeholder="نام درس را وارد کنید">
                                    <small class="text-danger" id="name">{{$errors->first('name')}}</small>
                                </div>
                                <div class="form-group @if ($errors->has('value')) has-error @endif">
                                    <label for="value">واحد درس</label>
                                    <input type="number" min="1" class="form-control" id="value" name="value" value="{{$lesson->value}}"
                                           placeholder="واحد درس را وارد کنید">
                                    <small class="text-danger" id="value">{{$errors->first('value')}}</small>
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

