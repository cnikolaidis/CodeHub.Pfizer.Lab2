<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersSkillsController extends Controller
{
    public function index(User $user)
    {
        return response()->json($user->skills, 200);
    }
}
