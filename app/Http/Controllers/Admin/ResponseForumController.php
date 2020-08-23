<?php

namespace App\Http\Controllers\Admin;

use App\Forum;
use App\Http\Controllers\Controller;
use App\ResponseForum;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResponseForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $this->authorize('view', Forum::class);
        $parent_menu_active='forum';
        $menu_active='forum';
        $talks = Forum::latest()->where('teacher_id', auth()->user()->id)->get();
        return view('Admin.forum.index', compact('talks','parent_menu_active','menu_active'));



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $talk=Forum::findOrFail($id);
//        $this->authorize('create', $talk);
        $parent_menu_active='forum';
        $menu_active='forum';
        return view('Admin.forum.response',compact('talk','parent_menu_active','menu_active'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('store', ResponseForum::class);
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
                'user_id' => $request->user_id,
                'teacher_id'=>$request->teacher_id,
                'lesson_id' => $request->lesson_id,
            ];
            ResponseForum::create(array_merge($data,['file'=>$upload_file]));

            session()->flash('success','تاپیک با موفقیت ثبت شد.');
            return  redirect()->back();
        }else{
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => $request->user_id,
                'teacher_id'=>$request->teacher_id,
                'lesson_id' => $request->lesson_id,
            ];
            ResponseForum::create($data);

            session()->flash('success','پاسخ با موفقیت ثبت شد.');
            return  redirect('admin/response_forums');
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

        $talk=Forum::findOrFail($id);
        $parent_menu_active='forum';
        $menu_active='forum';
        return  view('Admin.forum.show',compact('talk','parent_menu_active','menu_active'));
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
        $deleteItem=Forum::findOrFail($id);
        $deleteItem->delete();
        session()->flash('success','حذف با موفقیت انجام شد.');
        return  redirect()->back();

    }
    private function UploadFile($file)
    {

        $filename=time().'.'.$file->getClientOriginalName();
        $file->move(storage_path('/forum'),$filename);
        return $filename;
    }
    public function downloadFile($id)
    {

        $forum=Forum::FindOrFail($id);

        $hash = 'fds@#T@#56@sdgs131fasfq' . $forum->id. \request()->ip() . \request('t');

        if(Hash::check($hash , \request('mac'))) {
            if (file_exists(storage_path('forum/' . $forum->file))) {

                return response()->download(storage_path('forum/' . $forum->file));

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
