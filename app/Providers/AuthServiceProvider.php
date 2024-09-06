<?php

namespace App\Providers;

use App\Models\Comment;
use App\Policies\CommentPolicy;
use App\Models\Book;
use App\Http\Controllers\BookController;
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
        Comment::class => CommentPolicy::class, // Added Comment Policy Mapping
        // Add your model policies here if needed
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define the 'manage-book' gate
        Gate::define('manage-book', function ($user, Book $book) { // Ensure Book model is capitalized
            return $user->id === $book->user_id || $user->role === 'super_user';
        });
    }
}