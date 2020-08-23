<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examinfo extends Model
{
    protected  $fillable=['question_number','time','session_id','user_id','final_exam'];


    public  function  user()
    {
        return $this->belongsTo(User::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);

    }
}
