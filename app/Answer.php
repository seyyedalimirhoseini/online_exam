<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable=['true_answer','answer','user_id','user_name','lesson_name','session_name','teacher_id','score','exam_info_id'];

        public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function session()
    {
        return $this->belongsTo(Session::class);
    }
    public function getFieldAttributeName()
    {
        return  $this->user()->name;
    }
}
