<?php
namespace App\Policies;

use App\Models\Work;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class WorkPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function viewAnyEmployer(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Work $work): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->employer !== null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Work $work): bool|Response
    {
        if ($work->employer->user_id !== $user->id) {
            return false;
        }

        if ($work->workApplications()->count() > 0) {
            return Response::deny('Cannot change the job with applications');
        }

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Work $work): bool
    {
        return $work->employer->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Work $work): bool
    {
        return $work->employer->user_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Work $work): bool
    {
        return $work->employer->user_id === $user->id;
    }

    public function apply(User $user, Work $work): bool
    {
        return !$work->hasUserApplied($user);
    }
}
