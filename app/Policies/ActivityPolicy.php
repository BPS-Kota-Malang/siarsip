<?php

namespace App\Policies;

use App\Models\Activity;
use Illuminate\Foundation\Auth\User;

class ActivityPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }


    public function update(User $user, Activity $activity)
    {
        // Super admin dapat mengedit seluruh data
        if ($user->isAdmin()) {
            return true;
        }

        // Ketua tim dapat mengedit data dari timnya sendiri dan anggotanya
        if ($user->isTeamLeader()) {
            return $activity->team_leader_id == $user->id || $activity->added_by == $user->id;
        }

        // Anggota dapat mengedit data yang mereka tambahkan
        if ($user->isMember()) {
            return $activity->added_by == $user->id;
        }

        // Akses default ditolak
        return false;
    }


    public function delete(User $user, Activity $activity)
   {
        // Super admin dapat mengedit seluruh data
        if ($user->isAdmin()) {
            return true;
        }

        // Ketua tim dapat mengedit data dari timnya sendiri dan anggotanya
        if ($user->isTeamLeader()) {
            return $activity->team_leader_id == $user->id || $activity->added_by == $user->id;
        }

        // Anggota dapat mengedit data yang mereka tambahkan
        if ($user->isMember()) {
            return $activity->added_by == $user->id;
        }

        // Akses default ditolak
        return false;
    }
}
