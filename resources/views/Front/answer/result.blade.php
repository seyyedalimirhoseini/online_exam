@extends('Front.layouts.main')

@section('title','صفحه نتیجه آزمون')

<div id="services" class="section lb">
    <div class="container-fluid">
        <div class="section-title text-center">
            <br>
            <h4>نتیجه آزمون</h4>
            <div id="id"></div>
            @include('message')
        </div>
        @section('content')

            <table class="table table-hover" dir="rtl">

                <tbody>


                <?php echo 'فرصت باقی مانده:'.count($results).'/'. 3 ?>



                @foreach($results as $result)
                    <?php
                    $i = $result->count;
                    ?>

                    <tr>

                        <td>{{$i++}}</td>
                        <td>
                            @if($result->score ==$results->max('score') )
                                بیشترین نمره شما:

                            @endif
                        </td>
                        <td>


                            {{$result->score}}


                        </td>


                    </tr>




                @endforeach

                </tbody>
            </table>
            <?php
            $i = 1;


            ?>

            @if(count($results)>0)
                @if( count($results) ==3 )

                        <a href="{{route('index',$session->id)}}" class="btn- btn-info btn-sm"> بازگشت به صفحه اصلی</a>

                    @elseif(count($results) !=3 && $results->max('score') ==20)
                        <a href="{{route('index',$session->id)}}" class="btn- btn-info btn-sm"> بازگشت به صفحه اصلی</a>
                        @elseif(count($results) !=3 && $results->max('score') !=20)

                         <a href="{{route('showAnswer',['lesson_id'=>$lesson->id,'id'=>$session->id])}}" class="btn- btn-info btn-sm"> بازگشت به آزمون</a>
            @endif

    @endif



@endsection

