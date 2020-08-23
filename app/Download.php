<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected  $fillable =['user_id','session_id','time','date'];
    public  function user()
    {
        return $this->belongsTo(User::class);
    }
    public  function session()
    {
        return $this->belongsTo(User::class);
    }

}
