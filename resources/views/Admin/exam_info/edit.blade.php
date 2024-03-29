@extends('Admin.layouts.main_layout')
@section('title', 'صفحه ویرایش آزمون')
@section( 'content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">ویرایش آزمون</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">ویرایش آزمون</li>
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
                            <h3 class="card-title">ویرایش آزمون</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{route('exam_infos.update',$exam_info->id)}}" role="form">
                            @csrf
                            {{method_field('PATCH')}}
                            <div class="card-body">
                                <div class="form-group @if ($errors->has('question_number')) has-error @endif">
                                    <label for="question_number">تعداد سوالات</label>
                                    <input type="number" min="1" class="form-control" id="question_number"
                                           name="question_number" value="{{$exam_info->question_number}}"
                                           placeholder="تعداد سوالات را وارد کنید">
                                    <small class="text-danger"
                                           id="question_number">{{$errors->first('question_number')}}</small>
                                </div>
                                <div class="form-group @if ($errors->has('time')) has-error @endif">
                                    <label for="time">زمان آزمون</label>
                                    <div class="input-group ">

                                        <input type="number" min="1" class="form-control timepicker" id="time"
                                               name="time" value="{{$exam_info->time}}"
                                               placeholder="زمان آزمون را وارد کنید"
                                        >

                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                        </div>
                                    </div>
                                    <small class="text-danger" id="time">{{$errors->first('time')}}</small>
                                </div>
                                <div class="form-group">
                                    <label for="session_id">نام فصل</label>
                                    <select class="form-control select2" name="session_id" style="width: 100%;">

                                        @foreach($sessions as $key=>$value)

                                            <option @if($key == $exam_info->session_id) selected="selected"  @endif value="{{$key}}">{{$value}}</option>

                                            <!--                                        --><?php
                                            //                                            if($key!=0){
                                            //                                                $sessions=DB::table('sessions')->select('id','name')->where('lesson_id',$key)->get();
                                            //                                                if(count($sessions)>0){
                                            //                                                    foreach ( $sessions as  $session){
                                            //                                                        echo '<option value="'. $session->name.'">&nbsp;&nbsp;--'. $session->name.'</option>';
                                            //                                                    }
                                            //                                                }
                                            //                                            }
                                            //                                        ?>

                                        @endforeach
                                    </select>
                                </div>
{{--                                <label>--}}
{{--                                    امتحان نهایی:--}}
{{--                                    <input type="checkbox" name="final_exam" id="final_exam" value="1" {{$exam_info->final_exam==1 ? "checked":''}}>--}}

{{--                                </label>--}}
                            </div>
                            <!-- /.card-body -->
{{--                            <div class="form-group">--}}
{{--                                <input type="hidden" value="{{substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 5)}}" name="unique_id" class="form-control" id="unique_id">--}}
{{--                            </div>--}}
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

