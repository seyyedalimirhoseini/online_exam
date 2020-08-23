<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lesson;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Session::class);
        $role=auth()->user();

        if($role->isAdmin()) {

            $sessions = Session::latest()->get();
        }else
        {
            $sessions=Session::where('user_id' ,auth()->user()->id )->latest()->get();
        }
        $parent_menu_active='session';
        $menu_active='create_session';
        return  view('Admin.session.index',compact('parent_menu_active','menu_active','sessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Session::class);
        $parent_menu_active='session';
        $menu_active='create_session1';
        $lessons=Lesson::latest()->where('user_id',auth()->user()->id)->pluck('name','id');

        return  view('Admin.session.create',compact('parent_menu_active','menu_active','lessons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Session::class);
        $validatedData = $request->validate([
            'name' => 'required|unique:sessions,name|max:191',
            'file'=>'mimes:pdf|max:500',
            'video' => 'mimetypes:video/mp4,video/wmv,'

        ],[
            'name.required'=>'نام درس الزامی می باشد',
            'name.unique'=>'نام درس قبلا رزرو شده است',
            'name.max'=>'نام درس حداکثر باید 191 کاراکتر باشد',
            'file.mimes'=>'فرمت فایل بایدpdf  باشد',
            'file.max'=>'حداکثر حجم فایل باید 500 کیلوبایت باشد',
            'video.mimetypes'=>'فرمت ویدئو باید mp4 یاwmv باشد',
//            'video.max'=>'حداکثر حجم ویدئو باید1000 کیلوبایت باشد',
        ]);
        if($request->has('file'))
        {
            $file=$request->file('file');
            $upload_file=$this->UploadFile($file);
        }else{
            $upload_file=$request->file;
        }
        if($request->has('video'))
        {
            $video=$request->file('video');
            $upload_video=$this->UploadVideo($video);
        }else{
            $upload_video=$request->video;
        }
        if($request->video != null)
        {
           $request->validate([
                'time'=>'required',
           ],[

               'time.required'=>'انتخاب زمان الزامی می باشد'
           ]);
        }
        if ($request->video == null && $request->time !=null)
        {
            return  redirect()->back();

        }
//        $items=collect(Session::pluck('id'));
//            dd($items->values()->last());
//        if (count($items)>0)
//        {
//            $data=[
//                'id'=>$items->values()->last()+1,
//                'name'=>$request->name,
//                'time'=>$request->time,
//                'user_id'=>auth()->user()->id,
//                'lesson_id'=>$request->lesson_id,
//            ];
//        }else

            $data=[
                'name'=>$request->name,
                'time'=>$request->time,
                'user_id'=>auth()->user()->id,
                'lesson_id'=>$request->lesson_id,
            ];

        Session::create(array_merge($data,['file'=>$upload_file],['video'=>$upload_video]));
        session()->flash('success','فصل با موفقیت ساخته شد.');
        return redirect('admin/sessions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $session=Session::findOrFail($id);
        $this->authorize('update', $session);
        $parent_menu_active='session';
        $menu_active='create_session';

        $lessons=Lesson::latest()->where('user_id',auth()->user()->id)->pluck('name','id');

        return  view('Admin.session.edit',compact('session','parent_menu_active','menu_active','lessons'));
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
        $update_session=Session::findOrFail($id);
        $this->authorize('update', $update_session);
        $validatedData = $request->validate([
            'name' => 'required|unique:sessions,name,'.$update_session->id.',|max:191',
            'file'=>'mimes:pdf|max:500',
            'video' => 'mimetypes:video/mp4,video/wmv,'

        ],[
            'name.required'=>'نام درس الزامی می باشد',
            'name.unique'=>'نام فصل قبلا رزرو شده است',
            'name.max'=>'نام درس حداکثر باید 191 کاراکتر باشد',
            'file.mimes'=>'فرمت فایل بایدpdf  باشد',
            'file.max'=>'حداکثر حجم فایل باید 500 کیلوبایت باشد',
            'video.mimetypes'=>'فرمت ویدئو باید mp4 یاwmv باشد',
//            'video.max'=>'حداکثر حجم ویدئو باید1000 کیلوبایت باشد',
        ]);

        if($request->has('file'))
        {
            $file=$request->file('file');
            $upload_file=$this->UploadFile($file);
        }else{
            $upload_file=$request->file;
        }
        if($request->has('video'))
        {
            $video=$request->file('video');
            $upload_video=$this->UploadVideo($video);
        }else{
            $upload_video=$request->video;
        }
        if($request->video != null)
        {
            $request->validate([
                'time'=>'required',
            ],[

                'time.required'=>'انتخاب زمان الزامی می باشد'
            ]);
        }

        if ($request->video == null && $request->time !=null)
        {
                return  redirect()->back();
//            $request->validate([
//                'time'=>'nullable|',
//            ],[
//
//                'time.nullable'=>'شما مجاز به انتخاب  زمان نیستید.'
//            ]);
        }
        $data=[
            'name'=>$request->name,
            'time'=>$request->time,
            'user_id'=>auth()->user()->id,
            'lesson_id'=>$request->lesson_id,
        ];
        $update_session->update(array_merge($data,['file'=>$upload_file],['video'=>$upload_video]));
        session()->flash('success','فصل با موفقیت بروزرسانی شد');
        return redirect('admin/sessions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        $session = Session::findOrFail($id);
        $this->authorize('changeState', $session);
        $session->status = 1;
        $session->save();
        session()->flash('success', 'نمایش فصل فعال شد.');
        return redirect()->back();
    }

    public function inactive($id)
    {
        $lesson = Session::findOrFail($id);
        $this->authorize('changeState', $lesson);
        $lesson->status = 0;
        $lesson->save();
        session()->flash('success', 'نمایش فصل غیر فعال شد.');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $session=Session::findOrFail($id);
        $this->authorize('delete', $session);
        try{
            $session->delete();
            session()->flash('success','فصل با موفقیت حذف شد');
            return redirect()->back();
        }catch (\Exception $e)
        {
            session()->flash('error','فصل با موفقیت حذف نشد');
            return  redirect()->back();
        }

    }

    private function UploadFile($file)
    {

        $filename=time().'.'.$file->getClientOriginalName();
        $file->move(storage_path('/file'),$filename);
            return $filename;
    }


    private function UploadVideo( $video)
    {
        $videoname=time().'.'.$video->getClientOriginalName();
        $video->move(storage_path('/video'),$videoname);
        return $videoname;
    }
    public function downloadFile($id)
    {

            $session=Session::FindOrFail($id);
        $this->authorize('download', $session);
        $hash = 'fds@#T@#56@sdgs131fasfq' . $session->id. \request()->ip() . \request('t');

        if(Hash::check($hash , \request('mac'))) {
            if (file_exists(storage_path('file/' . $session->file))) {

                return response()->download(storage_path('file/' . $session->file));

            }
            else{
                return false;

            }

        }
        else {
            return 'لینک دانلود شما از کار افتاده است';
        }
    }
    public function downloadVideo($id)
    {

        $session=Session::FindOrFail($id);
        $this->authorize('download', $session);
        $hash = 'fds@#T@#56@sdgs131fasfq' . $session->id. \request()->ip() . \request('t');

        if(Hash::check($hash , \request('mac'))) {
            if (file_exists(storage_path("video/{$session->video}"))) {

                return response()->download(storage_path("video/{$session->video}"));

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
