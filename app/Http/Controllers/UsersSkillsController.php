<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersSkillsController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);

        return response()->json($user->skills, 200);
    }
}
