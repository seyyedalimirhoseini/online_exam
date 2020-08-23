<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\Examinfo;
use App\Http\Controllers\Controller;
use App\Lesson;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExaminfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Examinfo::class);
        $role=auth()->user();

        if($role->isAdmin()) {

            $exam_infos= Examinfo::latest()->get();
        }else
        {
            $exam_infos=Examinfo::where('user_id' ,auth()->user()->id )->latest()->get();
        }

        $parent_menu_active='exam_info';
        $menu_active='exam_info';
        return  view('Admin.exam_info.index',compact('parent_menu_active','menu_active','exam_infos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Examinfo::class);

        $parent_menu_active='exam_info';
        $menu_active='exam_info1';
        $sessions=Session::latest()->where('user_id',auth()->user()->id)->pluck('name','id');



        return  view('Admin.exam_info.create',compact('parent_menu_active','menu_active','sessions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Examinfo::class);

        $validatedData = $request->validate([
            'question_number'=>'required',
            'time'=>'required',
            'session_id'=>'unique:examinfos,session_id'
        ],[
            'question_number.required'=>'وارد کردن تعداد سوال الزامی می باشد' ,
            'time.required'=>'وارد کردن زمان آزمون الزامی می باشد' ,
            'session_id.unique'=>'نام فصل قبلا رزرو شده است.',
        ]);


//        $final_exam=DB::table('examinfos')->where('user_id',auth()->user()->id)->pluck('final_exam')->toArray();
        $max_id=Answer::where('teacher_id',auth()->user()->id)->max('session_id');
//        dd($max_id);

//        if (count($data)>0){
//            if(in_array('1',$final_exam)){
//                session()->flash('error','َشما دیگر نمی توانید آزمون بسازید!');
//                return  redirect()->back();
//            }
//        }

        $examinfo=new Examinfo();
        if (isset($max_id)) {
            if ($max_id < $request->session_id) {

                $examinfo->create([
                    'question_number' => $request->question_number,
                    'time' => $request->time,
                    'session_id' => $request->session_id,
                    'user_id' => auth()->user()->id,
                    'final_exam' => $request->final_exam,
//            'unique_id'=>$request->unique_id,
                ]);
                session()->flash('success', 'آزمون با موفقیت ساخته شد.');
                return redirect('admin/exam_infos');

            } else {
                session()->flash('error', 'شما دیگر نمی توانید برای این درس آزمون تعریف کنید!');
                return back();
            }
        }else{
            $examinfo->create([
                'question_number' => $request->question_number,
                'time' => $request->time,
                'session_id' => $request->session_id,
                'user_id' => auth()->user()->id,
                'final_exam' => $request->final_exam,
//            'unique_id'=>$request->unique_id,
            ]);
            session()->flash('success', 'آزمون با موفقیت ساخته شد.');
            return redirect('admin/exam_infos');

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
        $parent_menu_active='exam_info';
        $menu_active='exam_info1';
        $exam_info=Examinfo::findOrFail($id);
        $this->authorize('update', $exam_info);


        $sessions=Session::latest()->where('user_id',auth()->user()->id)->pluck('name','id');

        return view('Admin.exam_info.edit',compact('parent_menu_active','menu_active','sessions','exam_info'));
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
        $exam_info=Examinfo::findOrFail($id);
        $this->authorize('update', $exam_info);

        $validatedData = $request->validate([
            'question_number'=>'required',
            'time'=>'required',
            'session_id'=>'unique:examinfos,session_id,'.$exam_info->id.',',

        ],[
            'question_number.required'=>'وارد کردن تعداد سوال الزامی می باشد' ,
            'time.required'=>'وارد کردن زمان آزمون الزامی می باشد' ,
            'session_id.unique'=>'نام فصل قبلا رزرو شده است.',

        ]);
        $data=[
            'question_number'=>$request->question_number,
            'time'=>$request->time,
            'session_id'=>$request->session_id,
            'user_id'=>auth()->user()->id,
            'final_exam'=>$request->final_exam,
//            'unique_id'=>$request->unique_id,
        ];
//        $final_exam=DB::table('examinfos')->where('user_id',auth()->user()->id)->pluck('final_exam')->toArray();
//
//        if($exam_info->final_exam ==1) {
//
//        if ($request->final_exam == 1 ) {
//
//            $exam_info->update($data);
//            session()->flash('success','آزمون با موفقیت بروز رسانی شد');
//
//        }
//    }elseif ($exam_info->final_exam ==null ){
//
//        if ($request->final_exam == 1 && in_array('1',$final_exam)){
//                       session()->flash('error', 'شما یک دفعه آزمون نهایی ساخته اید!');
//                  return redirect()->back();
//        }
//    }
        $exam_info->update($data);
        session()->flash('success','آزمون با موفقیت بروز رسانی شد');
        return  redirect('admin/exam_infos');
    }
//    public function active($id)
//    {
//        $exam_info = Examinfo::findOrFail($id);
//        $this->authorize('changeState', $exam_info );
//        $exam_info ->status = 1;
//        $exam_info ->save();
//        session()->flash('success', 'نمایش آزمون فعال شد.');
//        return redirect()->back();
//    }
//
//    public function inactive($id)
//    {
//        $exam_info = Examinfo::findOrFail($id);
//        $this->authorize('changeState', $exam_info);
//        $exam_info->status = 0;
//        $exam_info->save();
//        session()->flash('success', 'نمایش آزمون غیر فعال شد.');
//        return redirect()->back();
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam_info=Examinfo::findOrFail($id);
        $this->authorize('update', $exam_info);

        try{
            $exam_info->delete();
            session()->flash('success','آزمون با موفقیت حذف شد');
            return  redirect()->back();
        }catch (\Exception $e)
        {
            session()->flash('error','آزمون با موفقیت حذف نشد');
            return  redirect()->back();
        }
    }
}
