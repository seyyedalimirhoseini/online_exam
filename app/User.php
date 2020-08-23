<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    const admin="admin";
    const teacher="teacher";
    const user="user";
    const role=[self::user,self::admin,self::teacher];


    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public  function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
    public function examinfos()
    {
        return $this->hasMany(Examinfo::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function downloads()
    {
        return $this->hasMany(Download::class);
    }
    public function forums()
    {
        return $this->hasMany(Forum::class);
    }
    public function response_forums()
    {
        return $this->hasMany(ResponseForum::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function isAdmin()
    {
        return auth()->user()->role=="admin" ? true:false;
    }
    public function isTeacher()
    {
        return auth()->user()->role=="teacher" ? true:false;
    }
    public function isUser()
    {
        return auth()->user()->role=="user" ? true:false;
    }

}
