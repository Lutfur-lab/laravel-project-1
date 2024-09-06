<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given comment can be deleted by the user.
     */
    public function delete(User $user, Comment $comment)
    {
        // Allow deletion only if the user is a super user (or whatever logic you need)
        return $user->is_super_user; // Replace with the actual logic for your super user check
    }
}
