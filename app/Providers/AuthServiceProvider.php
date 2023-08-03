<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

use App\Models\Lesson;
use App\Models\User;
use App\Policies\LessonPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        User::class => UserPolicy::class,
        Lesson::class => LessonPolicy::class,

        
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('update-post', [UserPolicy::class, 'update']);

        Passport::personalAccessTokensExpireIn(now()->addDays(60));
    }
}
