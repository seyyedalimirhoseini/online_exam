<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Lesson::class);
        $role = auth()->user();

        if ($role->isAdmin()) {

            $lessons = Lesson::latest()->get();
        } else {
            $lessons = Lesson::where('user_id', auth()->user()->id)->latest()->get();
        }


        $parent_menu_active = 'lessons';
        $menu_active = 'create_lesson';
        return view('Admin.lesson.index', compact('lessons', 'menu_active', 'parent_menu_active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Lesson::class);

        $parent_menu_active = 'lessons';
        $menu_active = 'create_lesson1';

        return view('Admin.lesson.create', compact('menu_active', 'parent_menu_active'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Lesson::class);

        $validatedData = $request->validate([
            'name' => 'required|unique:lessons,name|max:191',
            'value' => 'required|numeric',
        ], [
            'name.required' => 'نام درس الزامی می باشد',
            'name.unique' => 'نام درس قبلا رزرو شده است.',
            'name.max' => 'نام درس حداکثر باید 191 کاراکتر باشد.',
            'value.required' => 'وارد کردن واحد درس الزامی می باشد',
            'value.numeric' => 'واحد درس باید عدد باشد',
        ]);
        $data = [
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'value' => $request->value,
        ];
        Lesson::create($data);
        session()->flash('success', 'درس با موفقیت ساخته شد');
        return redirect('admin/lessons');
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
        $parent_menu_active = 'lessons';
        $menu_active = 'create_lesson';

        $lesson = Lesson::findOrFail($id);
        $this->authorize('update', $lesson);
        return view('Admin.lesson.edit', compact('lesson', 'parent_menu_active', 'menu_active'));

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
        $lesson = Lesson::findOrFail($id);
        $this->authorize('update', $lesson);
        $validatedData = $request->validate([
            'name' => 'required|unique:lessons,name,' . $lesson->id . ',|max:191',
            'value' => 'required|numeric',
        ], [
            'name.required' => 'نام درس الزامی می باشد',
            'name.unique' => 'نام درس قبلا رزرو شده است.',
            'name.max' => 'نام درس حداکثر باید 191 کاراکتر باشد.',
            'value.required' => 'وارد کردن واحد درس الزامی می باشد',
            'value.numeric' => 'واحد درس باید عدد باشد',
        ]);
        $data = [
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'value' => $request->value,
        ];
        $lesson->update($data);
        session()->flash('success', 'درس با موفقیت بروزرسانی شد');
        return redirect('admin/lessons');
    }

    public function active($id)
    {
        $lesson = Lesson::findOrFail($id);
        $this->authorize('changeState', $lesson);
        $lesson->status = 1;
        $lesson->save();


        session()->flash('success', 'نمایش درس فعال شد.');
        return redirect()->back();
    }

    public function inactive($id)
    {
        $lesson = Lesson::findOrFail($id);
        $this->authorize('changeState', $lesson);
        $lesson->status = 0;
        $lesson->save();


        session()->flash('success', 'نمایش درس غیر فعال شد.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $this->authorize('delete', $lesson);
        try {
            $lesson->delete();

            session()->flash('success', 'درس با موفقیت حذف شد');
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', 'درس با موفقیت حذف نشد');
            return redirect()->back();
        }
    }
}
