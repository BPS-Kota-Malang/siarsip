<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FilePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, File $file): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, File $file): bool
    {
        if ($user->isSuperadmin()) {
            // dd ($user->employee->division_id);
            return true;
        }

        // elseif ($user->isTeamLeader() && ($user->employee->division_id == $archive->activity->division_id || $user->id == $archive->user_id)){
        //     return true;
        // }
        if ($user->employee && $file->activity){
            if (($user->isTeamLeader() && ($user->employee->division_id == $file->activity->division_id || $user->id == $file->user_id)))
            {
                // dd ($file->activity->division_id);
                return true;
            }
        }
        // dd ($file->activity);
        return $user->id == $file->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, File $file): bool
    {
        if ($user->isSuperadmin()) {
            // dd ($user->employee->division_id);
            return true;
        }

        // elseif ($user->isTeamLeader() && ($user->employee->division_id == $archive->activity->division_id || $user->id == $archive->user_id)){
        //     return true;
        // }
        if ($user->employee && $file->activity){
            if (($user->isTeamLeader() && ($user->employee->division_id == $file->activity->division_id || $user->id == $file->user_id)))
            {
                // dd ($file->activity->division_id);
                return true;
            }
        }
        // dd ($file->activity);
        return $user->id == $file->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, File $file): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, File $file): bool
    {
        //
    }
}
