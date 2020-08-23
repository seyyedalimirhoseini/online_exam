@extends('Front.layouts.main')

@section('title','صفحه ایجاد تاپیک')


{{--        <div class="section-title text-center">--}}
<div class="title">

    <h4>ایجاد تاپیک جدید برای درس {{$lesson->name}}</h4>

</div>
@include('message')
@section('content')
    <div class="col-md-12">
        <div class="box2">
            <form method="post" action="{{route('forum.store')}}"  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                <input type="hidden" name="teacher_id" value="{{$lesson->user_id}}">
{{--                <input type="hidden" name="status" value="1">--}}
                <div class="form-group @if ($errors->has('title')) has-error @endif">
                    <label for="title">عنوان</label>
                    <input type="text" class="form-control" id="title" name="title"  value="{{old('title')}}">
                    <small class="text-danger" id="title">{{$errors->first('title')}}</small>
                </div>
                <div class="form-group @if ($errors->has('description')) has-error @endif">
                    <label for="description">متن</label>
                    <textarea class="form-control" id="description" name="description" rows="3" >{{old('description')}}</textarea>
                    <small class="text-danger" id="description">{{$errors->first('description')}}</small>
                </div>
                <div class="form-group @if ($errors->has('file')) has-error @endif">
                    <label for="file">فایل</label>
                    <input type="file" name="file" class="form-control">
                    <small class="text-danger" id="file">{{$errors->first('file')}}</small>
                </div>

                <button type="submit" class=" btn-success btn-sm">ارسال</button>
            </form>
        </div>
    </div>
@endsection

