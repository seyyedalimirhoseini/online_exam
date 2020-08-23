<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question', 'option1', 'option2', 'option3', 'option4', 'answer', 'grade', 'user_id', 'examinfo_id'
    ];
    public function examinfo()
    {
        return $this->belongsTo(Examinfo::class);


    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
