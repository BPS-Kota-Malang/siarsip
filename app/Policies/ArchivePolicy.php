<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Archive;
use Illuminate\Support\Facades\Response;

class ArchivePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Archive $activity)
    {
        // Super admin dapat mengedit seluruh data
        if ($user->isAdmin()) {
            return true;
        }

     // Ketua tim dapat menghapus data dari timnya sendiri dan anggotanya dengan divisi yang sama
if ($user->isTeamLeader()) {
    return $activity->team_leader_id == $user->id || ($activity->added_by != $user->id && $activity->division == $user->division && $activity->team_id == $user->team_id);
}


        // Anggota dapat mengedit data yang mereka tambahkan
        if ($user->isMember()) {
            return $activity->added_by == $user->id
            ? Response::allow()
            : Response::deny('You do not own this post.');
        }

        // Akses default ditolak
        return false;
    }


    public function delete(User $user, Archive $activity)
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
