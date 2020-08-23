<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Session extends Model
{
//    protected $fillable=['name','file','video','time','lesson_id','user_id','status'];

    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
    public function examinfo()
    {
        return $this->hasOne(Examinfo::class);
    }
    public function downloads()
    {
        return $this->hasMany(Download::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public  function downloadFile()
    {

        $timestamp = Carbon::now()->addHours(5)->timestamp;
        $hash = Hash::make('fds@#T@#56@sdgs131fasfq' . $this->id. request()->ip() . $timestamp);

        return  "download/file/$this->id?mac=$hash&t=$timestamp" ;


    }
    public  function downloadVideo()
    {

        $timestamp = Carbon::now()->addHours(5)->timestamp;
        $hash = Hash::make('fds@#T@#56@sdgs131fasfq' . $this->id. request()->ip() . $timestamp);

        return  "download/video/$this->id?mac=$hash&t=$timestamp" ;


    }
}
