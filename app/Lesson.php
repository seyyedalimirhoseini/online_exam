<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable=['name','value','user_id','status'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
    public function forums()
    {
        return $this->hasMany(Forum::class);
    }


}
