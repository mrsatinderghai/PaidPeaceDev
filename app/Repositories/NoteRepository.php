<?php

namespace App\Repositories;

use App\Models\Note;

class NoteRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */

    public function get_notes($id, $parent_type)
    {
        return Note::where(['parent_id' => $id, 'parent_type' => $parent_type])
            ->orderBy('created_at', 'desc')
            ->get();
    }

}