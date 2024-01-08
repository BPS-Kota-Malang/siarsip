<?php

namespace App\Policies;

// use App\Models\User;
use App\Models\Archive;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Auth\User;

class ArchivePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Archive $archive)
    {
        // Super admin dapat mengedit seluruh data
        if ($user->isAdmin()) {
            return true
            ? Response::allow()
            : Response::deny('You do not own this post.');
        }

     // Ketua tim dapat menghapus data dari timnya sendiri dan anggotanya dengan divisi yang sama
        if ($user->isTeamLeader()) {
            return $archive->team_leader_id == $user->id || ($archive->added_by != $user->id && $archive->division == $user->division && $archive->team_id == $user->team_id);
        }


        // Anggota dapat mengedit data yang mereka tambahkan
        if ($user->isMember()) {
            return $archive->added_by == $user->id
            ? Response::allow()
            : Response::deny('You do not own this post.');
        }

        // Akses default ditolak
        return false;
    }


    public function delete(User $user, Archive $archive)
   {
        // Super admin dapat mengedit seluruh data
        if ($user->isAdmin()) {
            return true;
        }

        // Ketua tim dapat mengedit data dari timnya sendiri dan anggotanya
        elseif ($user->isTeamLeader()) {
            return $archive->team_leader_id == $user->id || ($archive->added_by != $user->id && $archive->division == $user->division && $archive->team_id == $user->team_id);
        }

        // Anggota dapat mengedit atau menghapus data yang mereka tambahkan
        elseif ($user->isMember()) {
            return $archive->added_by == $user->id;
        }

        else{
        // Akses default ditolak
        return false;
        }
    }
}
