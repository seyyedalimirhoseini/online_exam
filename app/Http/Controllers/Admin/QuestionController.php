<?php

namespace App\Http\Controllers\Admin;

use App\Examinfo;
use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Question::class);
        $role=auth()->user();
            if($role->isAdmin())
            {
                $questions=Question::latest()->get();
            }else{
                $questions=Question::where('user_id',auth()->user()->id)->latest()->get();
            }

        $parent_menu_active = 'exam_info';
        $menu_active = 'exam_info';
        return view('Admin.question.index',compact('parent_menu_active','menu_active','questions'));
    }
    public function showQuestion($id)
    {
        $exam_info=Examinfo::findOrFail($id);



            $questions=Question::where('examinfo_id',$exam_info->id)->latest()->get();


        $parent_menu_active = 'exam_info';
        $menu_active = 'exam_info';
        return view('Admin.question.index',compact('parent_menu_active','menu_active','questions'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }
    public function  createQuestion($id)
    {
        $exam_info=Examinfo::findOrFail($id);
        $this->authorize('create', $exam_info);
        $parent_menu_active = 'exam_info';
        $menu_active = 'exam_info1';
        return view('Admin.question.create',compact('exam_info','parent_menu_active','menu_active'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('store', Question::class);
        $this->validate($request,[
           'question'=>'required',
           'option1'=>'required',
           'option2'=>'required',
           'option3'=>'required',
           'option4'=>'required',
            'answer'=>'required',
            'grade'=>'required|numeric|between:0.25,20',

        ],[
            'question.required'=>'وارد کردن سوال الزامی می باشد',
            'option1.required'=>'وارد کردن گزینه1 الزامی می باشد',
            'option2.required'=>'وارد کردن گزینه 2 الزامی می باشد',
            'option3.required'=>'وارد کردن گزینه 3 الزامی می باشد',
            'option4.required'=>'وارد کردن گزینه 4 الزامی می باشد',
            'answer.required'=>'وارد کردن جواب صحیح الزامی می باشد',
            'grade.required'=>'وارد کردن بارم نمره الزامی می باشد.',
            'grade.numeric'=>'بارم نمره باید عدد باشد',
            'grade.between'=>'بارم نمره باید بین 0.25 تا 20 باشد',
        ]);

        $id=$request->exam_info_id;
        $QuestionSum=Question::where('examinfo_id',$id)->sum('grade');

        $QuestionCount=Question::where('examinfo_id',$id)->count();

        $Question=Question::all();
        $SelectNumber=Examinfo::where('id',$id)->value('question_number');

//            $exam_info_id=DB::table('examinfos')->value('id');
            $exam_info_id=DB::table('questions')->where('examinfo_id',$id)->value('examinfo_id');


        if($QuestionCount < $SelectNumber)
            {
                if(count($Question)>0)
                {
                   if ($id == $exam_info_id) {
                       if ($QuestionCount == $SelectNumber || $QuestionSum + $request->grade != 20) {
                           session()->flash('error', 'مجموع بارم نمره باید 20 باشد');

                           return redirect()->back();
                       }
                   }
                }
                $question=Question::create ([
                    'question' => $request->question,
                    'option1' => $request->option1,
                    'option2' => $request->option2,
                    'option3' => $request->option3,
                    'option4' => $request->option4,
                    'answer' => $request->answer,
                    'grade'=>$request->grade,
                    'user_id' => auth()->user()->id,
                    'examinfo_id' => $request->exam_info_id,
                ]);
               session()->flash('success','سوال با موفقیت ساخته شد');

                return  redirect()->back();

            }


           else {

                session()->flash('error','شمادیگر نمی توانید سوال  بسازید!');
                return  redirect()->back();
            }
//        return redirect('admin/questions');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parent_menu_active='exam_info';
        $menu_active='exam_info1';
        $question=Question::findOrFail($id);


        $this->authorize('update', $question);
        return  view('Admin.question.edit',compact('question','parent_menu_active','menu_active'));
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

        $update_question = Question::findOrFail($id);
        $this->authorize('update', $update_question);
        $this->validate($request,[
            'question'=>'required',
            'option1'=>'required',
            'option2'=>'required',
            'option3'=>'required',
            'option4'=>'required',
            'answer'=>'required',
            'grade'=>'required|numeric|between:0.25,20',

        ],[
            'question.required'=>'وارد کردن سوال الزامی می باشد',
            'option1.required'=>'وارد کردن گزینه1 الزامی می باشد',
            'option2.required'=>'وارد کردن گزینه 2 الزامی می باشد',
            'option3.required'=>'وارد کردن گزینه 3 الزامی می باشد',
            'option4.required'=>'وارد کردن گزینه 4 الزامی می باشد',
            'answer.required'=>'وارد کردن جواب صحیح الزامی می باشد',
            'grade.required'=>'وارد کردن بارم نمره الزامی می باشد.',
            'grade.numeric'=>'بارم نمره باید عدد باشد',
            'grade.between'=>'بارم نمره باید بین 0.25 تا 20 باشد',
        ]);


        $data = [
            'question' => $request->question,
            'option1' => $request->option1,
            'option2' => $request->option2,
            'option3' => $request->option3,
            'option4' => $request->option4,
            'answer' => $request->answer,
            'grade'=>$request->grade,
            'user_id' => auth()->user()->id,
            'examinfo_id' => $request->exam_info_id,
        ];
        $exam_info_id2=DB::table('questions')->where('id',$id)->value('examinfo_id');
//            dd($exam_info_id2);
        $exam_id=intval($request->exam_info_id);
//        dd($exam_id);

        $QuestionSum=Question::where('examinfo_id',$exam_id)->where('id','!=',$update_question->id)->sum('grade');
//        dd($request->grade + $QuestionSum);
            if ($exam_info_id2 == $exam_id && $request->grade + $QuestionSum == 20) {
                $update_question->update($data);
                session()->flash('success', 'سوال با موفقیت بروزرسانی شد');
                return redirect('admin/exam_infos');
            }
            else{
                session()->flash('error','مجموع بارم نمره باید 20 باشد');

                return  redirect()->back();
            }




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $question=Question::findOrFail($id);
        $this->authorize('delete', $question);
        try {
            $id->delete();
            session()->flash('success','سوال با موفقیت حذف شد');
            return  redirect()->back();
        }catch (\Exception $e)
        {
            session()->flash('error','سوال با موفقیت حذف نشد');
            return  redirect()->back();
        }

    }
}
