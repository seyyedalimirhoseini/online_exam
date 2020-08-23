<?php

namespace App\Http\Controllers\Front;

use App\Forum;
use App\Http\Controllers\Controller;
use App\Lesson;
use App\ResponseForum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $lesson=Lesson::findOrFail($id);
        return view('Front.Forum.create',compact('lesson'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'=>'required',
            'description'=>'required|max:1000',
            'file'=>'mimes:pdf,zip,rar|max:2000',
        ],[
            'title.required'=>'وارد کردن عنوان الزامی می باشد.',
            'description.required'=>'وارد کردن توضیحات الزامی می باشد.',
            'description.max'=>'توضیحات باید 1000 کاراکتر می باشد.',
            'file.mimes'=>'فرمت فایل باید pdf یا zip یا rar باشد.',
            'file.max'=>'حجم فایل حداکثر2000 کیلوبایت باید باشد.'
        ]);
        if($request->has('file')) {
            $file = $request->file('file');
            $upload_file = $this->UploadFile($file);
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => auth()->user()->id,
                'teacher_id'=>$request->teacher_id,
                'lesson_id' => $request->lesson_id,
            ];
           Forum::create(array_merge($data,['file'=>$upload_file]));

            session()->flash('success','تاپیک با موفقیت ثبت شد.');
            return  redirect()->back();
        }else{
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => auth()->user()->id,
                'teacher_id'=>$request->teacher_id,
                'lesson_id' => $request->lesson_id,
                'status'=>$request->status,
            ];
            Forum::create($data);

            session()->flash('success','تاپیک با موفقیت ثبت شد.');
            return  redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson=Lesson::findOrFail($id);
        $talks=ResponseForum::latest()
            ->where([['user_id',auth()->user()->id]
                ,['lesson_id',$lesson->id]
                ,['teacher_id',$lesson->user_id]])
            ->get();
        return view('Front.Forum.show',compact('talks','lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function details($id)
    {
        $talk=ResponseForum::findOrFail($id);
        return view('Front.forum.details',compact('talk'));
    }
    private function UploadFile($file)
    {

        $filename=time().'.'.$file->getClientOriginalName();
        $file->move(storage_path('/forum'),$filename);
        return $filename;
    }
    public function downloadFile($id)
    {

        $response_forum=ResponseForum::FindOrFail($id);

        $hash = 'fds@#T@#56@sdgs131fasfq' . $response_forum->id. \request()->ip() . \request('t');

        if(Hash::check($hash , \request('mac'))) {
            if (file_exists(storage_path('forum/' . $response_forum->file))) {

                return response()->download(storage_path('forum/' . $response_forum->file));

            }
            else{
                return false;

            }

        }
        else {
            return 'لینک دانلود شما از کار افتاده است';
        }
    }
}
