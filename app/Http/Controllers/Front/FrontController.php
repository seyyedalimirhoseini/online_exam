<?php

namespace App\Http\Controllers\Front;

use App\Answer;
use App\Download;
use App\Examinfo;
use App\Http\Controllers\Controller;
use App\Lesson;
use App\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $lessons = Lesson::latest()->where('status', 1)->get();
        return view('Front.index', compact('lessons'));
    }

    public function details($id)
    {
        $lesson = Lesson::findOrFail($id);
        $sessions = $lesson->sessions()->where('status', 1)->get();

//        if ($sessionId->examinfo->id )

        $exam_infos = DB::table('examinfos')->pluck('session_id')->toArray();

        $s_id = Answer::where('user_id', auth()->user()->id)
            ->whereIn('session_id', $lesson->sessions()->pluck('id')->toArray())
            ->pluck('session_id', 'id')
            ->toArray();
//        if (!empty($s_id)) {

//                    $exam=\App\Session::where('id','>',$s_id)
            $exam = \App\Session::where('id', '>',$s_id!=null? max($s_id):'')
                ->whereIn('id', $exam_infos)
                ->where('lesson_id', $lesson->id)
                ->first();
//                        dd($exam);
//        }

        $item = \App\Answer::
        where('user_id', auth()->user()->id)

//                        ->where('session_id',$session->id)
            ->pluck('session_id')->toArray();
        $first_exam = \App\Session::where('id', '>', $lesson->sessions->first()->id)
            ->whereIn('id', $exam_infos)
//                        ->where('user_id', auth()->user()->id)
            ->where('lesson_id', $lesson->id)->first();
        return view('Front.details', compact('lesson', 'exam_infos', 's_id', 'sessions','exam','item','first_exam'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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

    public function downloadFile($id)
    {

        $session = Session::findOrFail($id);

        $hash = 'fds@#T@#56@sdgs131fasfq' . $session->id . \request()->ip() . \request('t');

        if (Hash::check($hash, \request('mac'))) {
            if (file_exists(storage_path('file/' . $session->file))) {
                $this->download($session);
                return response()->download(storage_path('file/' . $session->file));

            } else {
                return false;

            }

        } else {
            return 'لینک دانلود شما از کار افتاده است';
        }
    }

    public function downloadVideo($id)
    {
        $session = Session::findOrFail($id);


        $hash = 'fds@#T@#56@sdgs131fasfq' . $session->id . \request()->ip() . \request('t');

        if (Hash::check($hash, \request('mac'))) {
            if (file_exists(storage_path('video/' . $session->video))) {

                $this->download($session);

                return response()->download(storage_path('video/' . $session->video));

            } else {
                return false;

            }

        } else {
            return 'لینک دانلود شما از کار افتاده است';
        }
    }

    private function download($session)
    {
        Download::updateOrCreate(
            ['user_id' => auth()->user()->id, 'session_id' => $session->id],
            [
                'time' => jdate(Carbon::now())->format('H:i:s'),
                'date' => jdate(Carbon::now())->format('Y/m/d'),
            ]
        );
//        dd("l");
//            $downloads=Download::all();
//        $count=count($downloads);
//        $delete=Download::latest()
//            ->where('user_id',auth()->user()->id)
//            ->where('session_id',$session->id)
//            ->take($count)
//            ->skip(1)
//            ->get()
//            ->each(function ($row){
//                    $row->delete();
//            });

    }

}
