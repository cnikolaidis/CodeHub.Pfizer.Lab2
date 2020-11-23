<?php

namespace App\Http\Controllers;

use App\Models\Skill;

class SkillsController extends Controller
{
    public function index()
    {
        $skills = Skill::all();

        return response()->json($skills, 200);
    }
}
