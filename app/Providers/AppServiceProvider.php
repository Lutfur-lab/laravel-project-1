<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Comment;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\User;

//use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();
    
        Gate::define('manage-users', function ($user) {
            return $user->role === 'super_user';
        });

        Gate::define('delete-comment', function (User $user) {
            return $user->role === 'super_user';
        });

        Gate::define('manage-book', function (User $user, Book $book) {
            return $user->id === $book->user_id || $user->role === 'super_user';
        });
    }

    
}
