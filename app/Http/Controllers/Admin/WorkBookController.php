<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\Examinfo;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Answer::class);
        $parent_menu_active = 'workbook';
        $menu_active = 'workbook';
        $all_workbooks=User::pluck('id')->toArray();


        $sub = Answer::groupBy('session_id', 'count','user_name','lesson_name','session_name')
                ->where('teacher_id', auth()->user()->id)
                ->selectRaw('user_name,lesson_name,session_name,session_id, sum(score) as total_score, count');
//        dd($sub);
//        $workbooks = DB::table( DB::raw("({$sub->toSql()}) as sub") )
//            ->mergeBindings($sub->getQuery()) // you need to get underlying Query Builder
//            ->groupBy('session_id', 'user_id')
//            ->selectRaw('session_id, user_id, max(total_score) as max_score, max(count) as max_count')
//            ->get();
        $workbooks = DB::table( DB::raw("({$sub->toSql()}) as sub") )
            ->mergeBindings($sub->getQuery()) // you need to get underlying Query Builder
            ->groupBy('session_id','user_name','lesson_name','session_name')
            ->selectRaw('user_name,lesson_name,session_name,session_id, max(total_score) as max_score, max(count) as max_count')->get();


//dd($workbooks);
        return view('Admin.workbook.index',
            compact('parent_menu_active','menu_active','workbooks'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
