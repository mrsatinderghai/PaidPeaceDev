<?php

namespace App\Http\Controllers\Api\V1\Controllers;

use Illuminate\Routing\Controller;
use App\Task;

class TaskController extends Controller
{
    public function mine($user_id)
    {
        return Task::where('assigned_to_user_id', $user_id)
                  ->orderBy('due_date', 'asc')
                  ->get();
    }
}

?>
