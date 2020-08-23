@extends('Admin.layouts.main_layout')
@section('title', 'صفحه ایجاد سوال')
@section( 'content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">ایجاد سوال</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">ایجاد درس</li>
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
                            <h3 class="card-title">ایجاد سوال</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{route('questions.store')}}" role="form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group @if ($errors->has('question')) has-error @endif">
                                    <label for="question">سوال</label>
                                    <input type="text" max="100" class="form-control" id="question" name="question" value="{{old('question')}}"
                                           placeholder="سوال را وارد کنید">
                                    <small class="text-danger" id="name">{{$errors->first('question')}}</small>
                                </div>
                                <div class="form-group @if ($errors->has('option1')) has-error @endif">
                                    <label for="option1">گزینه1</label>
                                    <input type="text" max="100" class="form-control" id="option1" name="option1" value="{{old('option1')}}"
                                           placeholder="گزینه 1">
                                    <small class="text-danger" id="option1">{{$errors->first('option1')}}</small>
                                </div>
                                <div class="form-group @if ($errors->has('option2')) has-error @endif">
                                    <label for="option2">گزینه2</label>
                                    <input type="text" max="100" class="form-control" id="option2" name="option2" value="{{old('option2')}}"
                                           placeholder="گزینه 2">
                                    <small class="text-danger" id="option2">{{$errors->first('option2')}}</small>
                                </div>
                                <div class="form-group @if ($errors->has('option3')) has-error @endif">
                                    <label for="option3">گزینه3</label>
                                    <input type="text" max="100" class="form-control" id="option3" name="option3" value="{{old('option3')}}"
                                           placeholder="گزینه 3">
                                    <small class="text-danger" id="option3">{{$errors->first('option3')}}</small>
                                </div>
                                <div class="form-group @if ($errors->has('option4')) has-error @endif">
                                    <label for="option4">گزینه4</label>
                                    <input type="text"  max="100" class="form-control" id="option4" name="option4" value="{{old('option4')}}"
                                           placeholder="گزینه 4">
                                    <small class="text-danger" id="option4">{{$errors->first('option4')}}</small>
                                </div>
                                <div class="form-group @if ($errors->has('answer')) has-error @endif">
                                    <label for="answer">پاسخ صحیح</label>
                                    <input type="text" max="100" class="form-control" id="answer" name="answer" value="{{old('answer')}}"
                                           placeholder="پاسخ صحیح">
                                    <small class="text-danger" id="answer">{{$errors->first('answer')}}</small>
                                </div>
                                <div class="form-group @if ($errors->has('grade')) has-error @endif">
                                    <label for="grade">نمره</label>
                                    <input type="text"  class="form-control" id="grade" name="grade" value="{{old('grade')}}"
                                           placeholder="نمره">
                                    <small class="text-danger" id="grade">{{$errors->first('grade')}}</small>
                                </div>
                                <div class="form-group">

                                    <input type="hidden" name="exam_info_id" class="form-control" id="exam_info_id" value="{{$exam_info->id}}" >
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

