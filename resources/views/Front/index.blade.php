@extends('Front.layouts.main')

@section('title','صفحه اصلی')

        <div class="title">

            <h4>دورس ارائه شده</h4>

        </div>

        @section('content')

            <table class="table table-hover" dir="rtl">

                <tbody>
                <?php $i = 1 ?>
                @foreach($lessons as $lesson)
                    <tr>
                        <td scope="row">{{$i++}}</td>
                        <td>{{$lesson->name}}</td>
                        <td><a class="btn-primary" href="{{route('details',$lesson->id)}}">ورود به دوره</a></td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        @endsection

