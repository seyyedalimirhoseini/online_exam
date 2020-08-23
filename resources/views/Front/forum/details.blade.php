@extends('Front.layouts.main')

@section('title','صفحه مشاهده تالارگفتمان')

<div class="title">
    <h4>{{$talk->title}}</h4>

</div>
@section('content')
    <div class="overflow">
        {!! $talk->description !!}
    </div>
    @if($talk->file)
        <h6>فایل پیوست شده:</h6><a href="{{$talk->downloadFile()}}"><img src="{{url('/images/down.png')}}"
                                                 style="width: 20px"></a>
    @else
        فایل پیوست شده وجود ندارد
    @endif
@endsection

