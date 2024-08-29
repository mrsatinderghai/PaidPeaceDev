<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Note;
use App\User;

class NotePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user, Note $note)
    {
        return $user->id == $note->user_id OR $user->is_admin == 1;
    }
}
