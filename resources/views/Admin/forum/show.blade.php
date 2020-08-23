@extends('Admin.layouts.main_layout')
@section('title', 'صفحه مشاهده')
@section( 'content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">مشاهده</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">مشاهده</li>
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
                            <h3 class="card-title">مشاهده</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form >

                            <div class="card-body">
                                <div class="form-group ">
                                    <label for="name">عنوان</label>
                                    <input disabled type="text" class="form-control" id="name" name="name" value="{{$talk->title}}">

                                </div>
                                <div class="mb-3">
                                    <textarea  disabled id="editor1" name="description" style="width: 100%">{{$talk->description}}</textarea>
                                </div>


                            </div>
                            <!-- /.card-body -->


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
