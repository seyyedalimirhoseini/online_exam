@extends('Front.layouts.main')

@section('title','سر فصل های درسی')




<div id="services" class="section lb">
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box1">
                    <p>

                        خانه >> درس های من >> {{$lesson->name}} >> آزمون {{$session->name}}

                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <br>

        @section('content')
            <?php $i = 1 ?>
            <div class="col-md-2">
                <div class="box3">

                    <h4><b> <span id="timer" style="color: red"></span>:زمان باقی مانده</b></h4><br>


                </div>
            </div>
            <div class="col-md-8 ">

                <div class="box2">

                    @foreach($questions as $question)




                        <form method="post" action="{{route('answer.store')}} " class="ansform">
                            @csrf
                            <h3> ? {{$question->question}} </h3>

                            <input type="hidden" name="true_answer[{{$question->id}}]" value="{{$question->answer}}">
                            <input type="hidden" name="score[{{$question->id}}]" value="{{$question->grade}}">
                            <input type="hidden" name="session_id[{{$question->id}}]"
                                   value="{{$question->examinfo->session_id}}">
                            <input type="hidden" name="lesson_name[{{$question->id}}]"
                                   value="{{$question->examinfo->session->lesson->name}}">
                            <input type="hidden" name="sessionId" value="{{$question->examinfo->session_id}}">
                            <input type="hidden" name="session_name[{{$question->id}}]" value="{{$question->examinfo->session->name}}">

                            <input type="hidden" name="teacher_id[{{$question->id}}]"
                                   value="{{$question->examinfo->user_id}}">
                            {{$question->option1}}<input name="answer[{{$question->id}}]" value="{{$question->option1}}"
                                                         type="radio"> <br>
                            {{$question->option2}}<input name="answer[{{$question->id}}]" value="{{$question->option2}}"
                                                         type="radio"><br>
                            {{$question->option3}}<input name="answer[{{$question->id}}]" value="{{$question->option3}}"
                                                         type="radio"><br>
                            {{$question->option4}}<input name="answer[{{$question->id}}]" value="{{$question->option4}}"
                                                         type="radio"><br>
                            @endforeach
                            <input type="submit" name="submit" value="ثبت" class="btn-primary btn-sm " id="submitbtn">
                        </form>
                </div>

            </div>


    @endsection
    @section('script')
        <!-- script for time limitation of exam -->
            <script type="text/javascript">
                var timeoutHandle;

                function countdown(minutes) {
                    var seconds = 60;
                    var mins = minutes

                    function tick() {
                        var counter = document.getElementById("timer");
                        var current_minutes = mins - 1
                        seconds--;
                        counter.innerHTML =
                            current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
                        if (seconds > 0) {
                            timeoutHandle = setTimeout(tick, 1000);
                        } else {

                            if (mins > 1) {

                                // countdown(mins-1);   never reach “00″ issue solved:Contributed by Victor Streithorst
                                setTimeout(function () {
                                    countdown(mins - 1);
                                }, 1000);

                            }
                        }
                    }

                    tick();
                }

                countdown('<?php echo $time; ?>');

            </script>

            <!-- script for disable url -->
            <script type="text/javascript">
                var time = '<?php echo $time; ?>';
                var realtime = time * 60000;
                setTimeout(function () {
                        window.onbeforeunload = null;
                        alert('زمان آزمون به اتمام رسید!');
                        var id = '<?php echo $session->id; ?>';
                        var lesson_id = '<?php echo $lesson->id; ?>';

                        window.location.href = '<?php echo url('result');?>/'+lesson_id +'/'+ id;
                        {{--window.location.href = '<?php echo url('answer/store');?>'--}}
                    },
                    realtime);


            </script>
            <script>

             window.onbeforeunload = function(event) {


                 window.setTimeout(function () {

                        var id = '<?php echo $session->id; ?>';
                        var lesson_id = '<?php echo $lesson->id; ?>';
                    return  window.location.href = '<?php echo url('view');?>/'+lesson_id +'/'+ id;


                    }, 0);
                    window.onbeforeunload = null;



                }

            </script>

            <script type="text/javascript">
                $(document).ready(function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                });

                $('.ansform').on('submit', function (e) {
                    var form = $(this);
                    var submit = form.find("[type=submit]");
                    var submitOriginalText = submit.attr("value");

                    e.preventDefault();
                    var data = form.serialize();
                    var url = form.attr('action');
                    var post = form.attr('method');
                    $.ajax({
                        type: post,
                        url: url,
                        data: data,
                        success: function (data) {
                            window.onbeforeunload = null;
                            submit.attr("value", "ثبت شد");

                            var id = '<?php echo $session->id; ?>';
                            var lesson_id = '<?php echo $lesson->id; ?>';

                            window.location.href = '<?php echo url('result');?>/'+lesson_id +'/'+ id;


                        },
                        beforeSend: function () {
                            submit.attr("value", "درحال بارگذاری...");
                            submit.prop("disabled", true);
                        },
                        error: function () {
                            submit.attr("value", submitOriginalText);
                            submit.prop("disabled", false);
                            // show error to end user
                        }
                    })
                })
            </script>


@endsection
