@extends('Front.layouts.main')

@section('title','صفحه تالار گفتمان')

    <div class="title">
            <h4>تالار گفتمان درس {{$lesson->name}}</h4>

        </div>
        @section('content')
            <a class="btn-primary" href="{{route('forums.create',$lesson->id)}}">ایجاد تاپیک جدید</a>
            <table class="table table-hover" dir="rtl">

                <tbody>
                <tr>
                    <th>#</th>
                    <th>نام نویسنده</th>
                    <th>مشاهده/پاسخ</th>
                    <th>تاریخ ارسال</th>
                </tr>
                <?php $i = 1 ?>
                @foreach($talks as $talk)

                    <tr>
                        <td scope="row">{{$i++}}</td>
{{--                        <td>{{$talk->user->name}}</td>--}}
                        <td>
                            {{$talk->title}}
                            <br>
                            {{$lesson->user->name}}

                        </td>
                        <td><a href="{{route('forum.details',$talk->id)}}">مشاهده</a></td>

                        <td>{{jdate($talk->created_at)->format(' %d %B ، %Y')}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
@endsection

