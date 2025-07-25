<?php

namespace App\Policies;

use App\Models\ResearchRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ResearchRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
     return in_array($user->role, ['admin', 'student']);   
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ResearchRequest $researchRequest): bool
    {
        return in_array($user->role, ['admin']) || $user->id === $researchRequest->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'student']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ResearchRequest $researchRequest): bool
    {
        return in_array($user->role, ['admin', 'student']) && $user->id === $researchRequest->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ResearchRequest $researchRequest): bool
    {
        return in_array($user->role, ['admin', 'student']) && $user->id === $researchRequest->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ResearchRequest $researchRequest): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ResearchRequest $researchRequest): bool
    {
        //
    }
}
