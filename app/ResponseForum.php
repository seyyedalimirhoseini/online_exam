<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;


class ResponseForum extends Model
{
    protected $fillable=['title','description','file','user_id','teacher_id','lesson_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public  function downloadFile()
    {

        $timestamp = Carbon::now()->addHours(5)->timestamp;
        $hash = Hash::make('fds@#T@#56@sdgs131fasfq' . $this->id. request()->ip() . $timestamp);

        return  "/details/download/response_forum_file/$this->id?mac=$hash&t=$timestamp" ;


    }
}
