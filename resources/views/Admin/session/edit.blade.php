@extends('Admin.layouts.main_layout')
@section('title', 'صفحه ویرایش فصل')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset("/admin/dist/bootstrap-clockpicker.min.css")}}">
    <link rel="stylesheet" href="{{asset("/admin/plugins/select2/select2.min.css")}}">
    <link type="text/css" href="{{asset("/admin/dist/css/bootstrap-timepicker.min.css")}}" />
@endsection
@section( 'content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">ویرایش فصل</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">ویرایش فصل</li>
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
                            <h3 class="card-title">ویرایش فصل</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{route('sessions.update',$session->id)}}" role="form"
                              enctype="multipart/form-data">
                            @csrf
                            {{method_field('PATCH')}}
                            <div class="card-body">
                                <div class="form-group @if ($errors->has('name')) has-error @endif">
                                    <label for="name">نام فصل</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{$session->name}}"
                                           placeholder="نام فصل را وارد کنید">
                                    <small class="text-danger" id="name">{{$errors->first('name')}}</small>
                                </div>
                                <div class="form-group  @if ($errors->has('file')) has-error @endif">
                                    <label for="file" class="control-label">فایل</label>
                                    <input type="file" class="form-control" name="file" id="file"
                                           placeholder="فایل را وارد کنید" value="{{$session->file }}">
                                    <small class="text-danger" id="file">{{$errors->first('file')}}</small>
                                </div>
                                <div class="form-group  @if ($errors->has('video')) has-error @endif">
                                    <label for="video" class="control-label">ویدئو</label>
                                    <input type="file" class="form-control" name="video" id="video"
                                           placeholder="ویدئو را وارد کنید" value="{{ $session->video }}">
                                    <small class="text-danger" id="video">{{$errors->first('video')}}</small>
                                </div>
                                <label for="time">زمان ویدئو</label>

                                <div class="input-group @if ($errors->has('time')) has-error @endif">
                                    <input id="timepicker2" placeholder="--:--:-" type="text" value="{{$session->time}}" name="time" class="form-control input-small">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                </div>
                                <small class="text-danger" id="time">{{$errors->first('time')}}</small>
                                <div class="form-group">
                                    <label for="lesson_id">نام درس</label>
                                    <select class="form-control select2" name="lesson_id" style="width: 100%;">
                                        @foreach($lessons as $key=>$value)
                                            <option @if($key == $session->lesson_id)  selected="selected" @endif
                                            value="{{$key}}"
                                                   >{{$value}}
                                            </option>



                                        @endforeach

                                    </select>
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
@section('script')
    <script type="text/javascript" src="{{asset("/admin/dist/bootstrap-clockpicker.min.js")}}"></script>
    <script src={{asset("/admin/plugins/select2/select2.full.min.js")}}></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

        })
    </script>
    <script type="text/javascript" src="{{asset("admin/dist/js/bootstrap-timepicker.min.js")}}"></script>
    <script type="text/javascript">
        $('#timepicker2').timepicker({
            minuteStep: 1,
            template: 'modal',
            appendWidgetTo: 'body',
            showSeconds: true,
            showMeridian: false,
            defaultTime: false
        });
    </script>
@endsection
