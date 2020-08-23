@extends('Front.layouts.main')

@section('title','سر فصل های درسی')


<div id="services" class="section lb">

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box1">
                <p>
                    خانه >> درس های من >>{{$lesson->name}}

                </p>
            </div>
        </div>
    </div>
</div>


@section('content')
    <?php $i = 1 ?>
    <div class="col-md-2">
        <a class="btn-primary" href="{{route('forum.show',$lesson->id)}}">تالار گفتمان</a>
    </div>
    <div class="col-md-10 ">
        <div class="box2">

            <div class="section-title text-center">

                <h4>این درس توسط استاد {{$lesson->user->name}} در {{$lesson->sessions()->count()}}جلسه تهیه شده
                    است </h4>

            </div>


            @foreach($sessions as $session)
                <?php $count = $i++ ?>
{{--                <h2>{{$session->name}}</h2>--}}
{{--                @if(isset($session->file))--}}

{{--                    <a class="" href="{{$session->downloadFile()}}">دانلود درس{{$count}}</a><img class="image"--}}
{{--                                                                                                 src="{{asset('/front/images/pdf-24.png')}}">--}}
{{--                    <br>--}}
{{--                @endif--}}
{{--                @if(isset($session->video))--}}
{{--                    <a href="{{$session->downloadVideo()}}">دانلود ویدئو{{$count}}</a><img class="image"--}}
{{--                                                                                           src="{{asset('/front/images/mpeg-24.png')}}">--}}
{{--                    <br>--}}
{{--                @endif--}}


                    @if(in_array($session->id,$exam_infos) )
                        @if(isset($first_exam) )
                        @if($lesson->sessions->first()->id == $session->id  && in_array($lesson->sessions->first()->id,$exam_infos))
                                <h2>{{$session->name}}</h2>
                                @if(isset($session->file))

                                <a class="" href="{{$session->downloadFile()}}">دانلود درس{{$count}}</a><img class="image"
                                                                                                             src="{{asset('/front/images/pdf-24.png')}}">
                                <br>
                                @endif
                                @if(isset($session->video))
                                <a href="{{$session->downloadVideo()}}">دانلود ویدئو{{$count}}</a><img class="image" src="{{asset('/front/images/mpeg-24.png')}}">
                                <br>
                                @endif
                                <a href="{{route('showAnswer',['lesson_id'=>$lesson->id,'id'=>$session->id])}}">آزمون{{$count}}</a><img class="image" src="{{asset('/front/images/icon.svg')}}">
                            <br>
                                <a href="{{route('result',['lesson_id'=>$lesson->id,'id'=>$session->id])}}">نتیجه آزمون{{$count}}</a>
                                <br>
                                {{--                        @elseif($lesson->sessions->first()->id == $session->id && !in_array($lesson->sessions->first()->id,$exam_infos) )--}}
                        @elseif($first_exam->id == $session->id && !in_array($lesson->sessions->first()->id,$exam_infos) )
                                <h2>{{$session->name}}</h2>
                                @if(isset($session->file))

                                    <a class="" href="{{$session->downloadFile()}}">دانلود درس{{$count}}</a><img class="image"
                                                                                                                 src="{{asset('/front/images/pdf-24.png')}}">
                                    <br>
                                @endif
                                @if(isset($session->video))
                                    <a href="{{$session->downloadVideo()}}">دانلود ویدئو{{$count}}</a><img class="image" src="{{asset('/front/images/mpeg-24.png')}}">
                                    <br>
                                @endif
                                <a href="{{route('showAnswer',['lesson_id'=>$lesson->id,'id'=>$session->id])}}">آزمون{{$count}}</a><img class="image" src="{{asset('/front/images/icon.svg')}}">
                                <br>
                                <a href="{{route('result',['lesson_id'=>$lesson->id,'id'=>$session->id])}}">نتیجه آزمون{{$count}}</a>
                                <br>
                            @elseif($s_id!=null?in_array($session->id,$item) :'')
                                <h2>{{$session->name}}</h2>
                                @if(isset($session->file))

                                    <a class="" href="{{$session->downloadFile()}}">دانلود درس{{$count}}</a><img class="image"
                                                                                                                 src="{{asset('/front/images/pdf-24.png')}}">
                                    <br>
                                @endif
                                @if(isset($session->video))
                                    <a href="{{$session->downloadVideo()}}">دانلود ویدئو{{$count}}</a><img class="image" src="{{asset('/front/images/mpeg-24.png')}}">
                                    <br>
                                @endif
                                <a href="{{route('showAnswer',['lesson_id'=>$lesson->id,'id'=>$session->id])}}">آزمون{{$count}}</a><img class="image" src="{{asset('/front/images/icon.svg')}}">
                                <br>
                                <a href="{{route('result',['lesson_id'=>$lesson->id,'id'=>$session->id])}}">نتیجه آزمون{{$count}}</a>
                                <br>
                            @elseif($s_id!=null?$exam->id == $session->id :'')
                                <h2>{{$session->name}}</h2>
                                @if(isset($session->file))

                                    <a class="" href="{{$session->downloadFile()}}">دانلود درس{{$count}}</a><img class="image"
                                                                                                                 src="{{asset('/front/images/pdf-24.png')}}">
                                    <br>
                                @endif
                                @if(isset($session->video))
                                    <a href="{{$session->downloadVideo()}}">دانلود ویدئو{{$count}}</a><img class="image" src="{{asset('/front/images/mpeg-24.png')}}">
                                    <br>
                                @endif
                                <a href="{{route('showAnswer',['lesson_id'=>$lesson->id,'id'=>$session->id])}}">آزمون{{$count}}</a><img class="image" src="{{asset('/front/images/icon.svg')}}">
                                <br>
                                <a href="{{route('result',['lesson_id'=>$lesson->id,'id'=>$session->id])}}">نتیجه آزمون{{$count}}</a>
                                <br>
                            @else
{{--                            @foreach($no_exams as $no_exam)--}}
{{--                                @if ($loop->first) @continue @endif--}}
                            <a>  {{$count}}آزمون شماره </a>
                            <br>
{{--                            @endforeach--}}
                        @endif
                        @else
                            <h2>{{$session->name}}</h2>
                            @if(isset($session->file))

                                <a class="" href="{{$session->downloadFile()}}">دانلود درس{{$count}}</a><img class="image"
                                                                                                             src="{{asset('/front/images/pdf-24.png')}}">
                                <br>
                            @endif
                            @if(isset($session->video))
                                <a href="{{$session->downloadVideo()}}">دانلود ویدئو{{$count}}</a><img class="image" src="{{asset('/front/images/mpeg-24.png')}}">
                                <br>
                            @endif
                            <a href="{{route('showAnswer',['lesson_id'=>$lesson->id,'id'=>$session->id])}}">آزمون{{$count}}</a><img class="image" src="{{asset('/front/images/icon.svg')}}">
                            <br>
                            <a href="{{route('result',['lesson_id'=>$lesson->id,'id'=>$session->id])}}">نتیجه آزمون{{$count}}</a>
                            <br>
                        @endif

                    @endif

{{--                    @if($session->examinfo !=null)--}}
{{--                        <br>--}}
{{--                    <a href="{{route('result',['lesson_id'=>$lesson->id,'id'=>$session->id])}}">نتیجه آزمون{{$count}}</a>--}}
{{--                    @endif--}}

            @endforeach


        </div>
    </div>



@endsection


