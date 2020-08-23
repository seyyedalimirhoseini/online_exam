<?php

namespace App\Http\Controllers\Front;

use App\Answer;
use App\Download;
use App\Examinfo;
use App\Lesson;
use App\Question;
use App\Http\Controllers\Controller;
use App\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use function Sodium\increment;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function showAnswer($lesson_id, $id)
    {
        $session = Session::findOrFail($id);
        $lesson = Lesson::findOrFail($lesson_id);
        $s_id = Answer::where('user_id', auth()->user()->id)
            ->whereIn('session_id', $lesson->sessions()->pluck('id')->toArray())
            ->pluck('session_id', 'id')
            ->toArray();

        $exam_infos = DB::table('examinfos')->pluck('session_id')->toArray();
//        if (!empty($s_id)) {
            $exam = \App\Session::where('id', '>', $s_id!=null? max($s_id):'')
                ->whereIn('id', $exam_infos)
                ->where('lesson_id', $lesson->id)
                ->first();
//            dd($exam);
//        }
        $first_exam = \App\Session::where('id', '>', $lesson->sessions->first()->id)
            ->whereIn('id', $exam_infos)
//                        ->where('user_id', auth()->user()->id)
            ->where('lesson_id', $lesson->id)->first();
        $item = \App\Answer::
        where('user_id', auth()->user()->id)
            ->where('session_id', $session->id)
            ->pluck('session_id')->toArray();
//    dd($item);
        $results = Answer::groupBy('count')
            ->where('user_id', auth()->user()->id)
            //    ->whereColumn('true_answer', '=', 'answer')
            ->selectRaw('sum(score) as score,count')
            ->where('session_id', $session->id)
            ->get();
        $downloads = Download::all();
        if (!empty($session->examinfo['id'])) {
            $examinfo_id = $session->examinfo['id'];
            // dd($examinfo_id);
        } else {
            return redirect()->back();
        }
        $lesson = $session->lesson()->first();
//

        $answers = [
            'true_answer' => 0,
            'user_id' => auth()->user()->id,
            'user_name'=>auth()->user()->name,
            'answer' => 0,
            'score' => 0,
            'session_id' => $session->id,
            'session_name'=>$session->name,
            'lesson_name'=>  $lesson->name,
            'teacher_id' => $session->user_id

        ];
//        dd($answers);

        if (!$sock = @fsockopen('www.google.com', 80)) {

            $insert = Answer::where('user_id', auth()->user()->id)->where('session_id', $session->id)->increment('count');
//            $increment = Answer::where('user_id', auth()->user()->id)->where('session_id', $session->id)->increment('increment');


            $data = Answer::insert($answers);
            echo "اینترنت شما قطع می باشد";
        } else {
            $time = DB::table('examinfos')->where('session_id', $session->id)->value('time');

//            $questions = Question::where('examinfo_id', $examinfo_id)->get();
            $questions = collect(Question::all()->where('examinfo_id', $examinfo_id))->shuffle();
            $session_id = Download::
            where('user_id', auth()->user()->id)->
            pluck('session_id')->toArray();
//                dd($session_id);
            $user_id = Download::pluck('user_id')->toArray();
            if (count($downloads) > 0 && in_array($session->id, $exam_infos)) {
//                if (!empty($exam)) {
//                    dd('true');
                foreach ($downloads as $download) {
                    if (empty($exam) && (count($results)==3 && $results->max('score') == 20)) {
//                        return view('Front.answer.show', compact('questions', 'time', 'lesson', 'session', 'session_id'));
                       return  redirect()->back();
                    }if (empty($exam) && (count($results)!=3 && $results->max('score') != 20)){
                        return view('Front.answer.show', compact('questions', 'time', 'lesson', 'session', 'session_id'));

                    }
                    else {
//                        dd('false');
                        if ((in_array(auth()->user()->id, $user_id) && in_array($session->id, $session_id)) && (count($results) != 3 && $results->max('score') != 20) && (($lesson->sessions->first()->id == $session->id && in_array($lesson->sessions->first()->id, $exam_infos)) || ($s_id != null ? $exam->id == $session->id : '') || ($s_id != null ? in_array($session->id, $item) != false : '') || $first_exam->id == $session->id && !in_array($lesson->sessions->first()->id, $exam_infos))) {
//                                dd('true');
                            $secs = strtotime($session->time) - strtotime("00:00:00");
                            $result = date("H:i:s", strtotime($download->time) + $secs);
                            $date = jdate(Carbon::now())->format('Y/m/d');
                            if (isset($session->time)) {

                                if (($date >= $download->date && jdate(Carbon::now())->format('H:i:s') >= $result) && (count($results) != 3 && $results->max('score') != 20) && (($lesson->sessions->first()->id == $session->id) || ($s_id != null ? $exam->id == $session->id : '') || ($s_id != null ? in_array($session->id, $item) != false : '') || $first_exam->id == $session->id && !in_array($lesson->sessions->first()->id, $exam_infos))) {

                                    return view('Front.answer.show', compact('questions', 'time', 'lesson', 'session', 'session_id'));

                                } elseif (($date > $download->date && jdate(Carbon::now())->format('H:i:s') < $result) && (count($results) != 3 && $results->max('score') != 20) && (($lesson->sessions->first()->id == $session->id) || ($s_id != null ? $exam->id == $session->id : '') || ($s_id != null ? in_array($session->id, $item) != false : '') || $first_exam->id == $session->id && !in_array($lesson->sessions->first()->id, $exam_infos))) {

                                    return view('Front.answer.show', compact('questions', 'time', 'lesson', 'session', 'session_id'));

                                } else {

                                    return " شما باید حداقل $session->time صبر کنید ";
                                }

                            } else {

                                return view('Front.answer.show', compact('questions', 'time', 'lesson', 'session', 'session_id'));

                            }

                        } else {
//                                dd('false');
                            return 'امکان دادن آزمون وجود ندارد';
                        }


                    }

                }
            }
                    else {

                    return 'امکان دادن آزمون وجود ندارد';

                }
//            }
//            else{
//                dd('false');
//            }

        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'answer' => 'required',

        ]);
        $results = Answer::groupBy('count')
            ->where('user_id', auth()->user()->id)
            //    ->whereColumn('true_answer', '=', 'answer')
            ->selectRaw('sum(score) as score,count')
            ->where('session_id', $request->session_id)
            ->get();

        $answer = $request['answer'];
//        if ($request->ajax()) {
            if (isset($answer)) {
                if (!empty($results) ) {
                        if (count($results) !=3 && $results->max('score') !=20){
                        foreach ($answer as $key => $value) {

                            $answers[] = [
                                'true_answer' => $request->true_answer[$key],
                                'user_id' => auth()->user()->id,
                                'user_name'=>auth()->user()->name,
                                'answer' => $request->answer[$key],
                                'score' => $request->score[$key],
                                'session_id' => $request->session_id[$key],
                                'session_name' => $request->session_name[$key],
                                'lesson_name'=>$request->lesson_name[$key],
                                'teacher_id' => $request->teacher_id[$key]


                            ];


                        }

                        $insert = Answer::where('user_id', auth()->user()->id)->where('session_id', $request->sessionId)->increment('count');
//                        $increment = Answer::where('user_id', auth()->user()->id)->where('session_id', $request->sessionId)->increment('increment');
                        $data = Answer::insert($answers);

                }

            }
        }
        else {
            return "ajax not done";
        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function result(Request $request, $lesson_id, $id)
    {
        $session = Session::findOrFail($id);
        $lesson = Lesson::findOrFail($lesson_id);
        $data = array(

            'score' => 0,
        );
        $answer = $request['answer'];
//        dd($answer);
//        if ($request->method() != 'POST') {
//            foreach ($answer as $key => $value) {
//
//                $item = array(
//                    'true_answer' => $request->true_answer[$key],
//                    'user_id' => auth()->user()->id,
//                    'answer' => $request->answer[$key],
//                    'score' => $request->score[$key],
//                    'session_id' => $request->session_id[$key],
//                    'teacher_id' => $request->teacher_id[$key]
//                );
//            }
//            DB::table('answers')
//                ->where('user_id', auth()->user()->id)
//                ->where('session_id', $session->id)
//                ->update($item);
//        }
        DB::table('answers')
            ->where('user_id', auth()->user()->id)
            ->whereColumn('true_answer', '!=', 'answer')
            ->where('session_id', $session->id)
            ->update($data);

        $results = Answer::groupBy('count')
            ->where('user_id', auth()->user()->id)
            //    ->whereColumn('true_answer', '=', 'answer')
            ->selectRaw('sum(score) as score,count')
            ->where('session_id', $session->id)
            ->get();

        return view('Front.answer.result', compact(
            'results', 'session', 'lesson'));


    }

    public function view($lesson_id, $id)
    {
        $session = Session::findOrFail($id);
        $lesson = Lesson::findOrFail($lesson_id);

        $answers = [
            'true_answer' => 0,
            'user_id' => auth()->user()->id,
            'user_name'=>auth()->user()->name,
            'answer' => 0,
            'score' => 0,
            'session_id' => $session->id,
            'session_name'=>$session->name,
            'lesson_name'=>  $lesson->name,
            'teacher_id' => $session->user_id

        ];
        $insert = Answer::where('user_id', auth()->user()->id)->where('session_id', $session->id)->increment('count');
//        $increment = Answer::where('user_id', auth()->user()->id)->where('session_id', $session->id)->increment('increment');


        $data = Answer::insert($answers);
        return \Redirect::route('result', ['lesson_id' => $lesson_id, 'id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
