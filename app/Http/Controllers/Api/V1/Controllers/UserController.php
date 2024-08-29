<?php

namespace App\Http\Controllers\Api\V1\Controllers;

use Illuminate\Routing\Controller;
use App\User;

class UserController extends Controller
{
    public function show($id)
    {
        return User::findOrFail($id);
    }
}

?>
