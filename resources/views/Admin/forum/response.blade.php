@extends('Admin.layouts.main_layout')
@section('title', 'صفحه پاسخ')

@section( 'content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">پاسخ</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">پاسخ</li>
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
                            <h3 class="card-title">پاسخ</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{route('response_forums.store')}}" role="form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="lesson_id" value="{{$talk->lesson_id}}">
                            <input type="hidden" name="teacher_id" value="{{$talk->teacher_id}}">
                            <input type="hidden" name="user_id" value="{{$talk->user_id}}">
{{--                            <input type="hidden" name="status" value="1">--}}
                            <div class="card-body">
                                <div class="form-group @if ($errors->has('title')) has-error @endif">
                                    <label for="name">عنوان</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           value="{{old('title')}}"
                                           placeholder="عنوان را وارد کنید.">
                                    <small class="text-danger" id="title">{{$errors->first('title')}}</small>
                                </div>
                                <div class="mb-3 @if ($errors->has('description')) has-error @endif">
                                    <textarea id="editor1" name="description" style="width: 100%">{{old('description')}}</textarea>
                                    <small class="text-danger" id="description">{{$errors->first('description')}}</small>

                                </div>
                                <div class="form-group  @if ($errors->has('file')) has-error @endif">
                                    <label for="file" class="control-label">فایل</label>
                                    <input type="file" class="form-control" name="file" id="file"
                                           placeholder="فایل را وارد کنید" value="{{ old('file') }}">
                                    <small class="text-danger" id="file">{{$errors->first('file')}}</small>
                                </div>





                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">ایجاد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src={{asset("/admin/plugins/ckeditor/ckeditor.js")}}></script>
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            ClassicEditor
                .create(document.querySelector('#editor1'))
                .then(function (editor) {
                    // The editor instance
                })
                .catch(function (error) {
                    console.error(error)
                })

            // bootstrap WYSIHTML5 - text editor

            $('.textarea').wysihtml5({
                toolbar: { fa: true }
            })
        })
    </script>
@endsection
