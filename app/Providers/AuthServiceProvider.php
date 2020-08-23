<?php

namespace App\Providers;

use App\Answer;
use App\Examinfo;
use App\Lesson;
use App\Policies\ExaminfoPolicy;
use App\Policies\LessonPolicy;
use App\Policies\ProfilePolicy;
use App\Policies\QuestionPolicy;
use App\Policies\ResponseForumPolicy;
use App\Policies\SessionPolicy;
use App\Policies\WorkbookPolicy;
use App\Question;
use App\ResponseForum;
use App\Session;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Lesson::class => LessonPolicy::class,
        Session::class => SessionPolicy::class,
        Examinfo::class=>ExaminfoPolicy::class,
        Question::class=>QuestionPolicy::class,
        ResponseForum::class=>ResponseForumPolicy::class,
        User::class=>ProfilePolicy::class,
        Answer::class=>WorkbookPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function($user) {
            return $user->role == 'admin';
        });

        /* define a manager user role */
        Gate::define('isTeacher', function($user) {
            return $user->role == 'manager';
        });

        /* define a user role */
        Gate::define('isUser', function($user) {
            return $user->role == 'user';
        });
    }

}
