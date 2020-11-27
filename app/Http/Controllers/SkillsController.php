<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillsUpdateRequest;
use App\Http\Requests\SkillsStoreRequest;
use App\Models\Skill;

class SkillsController extends Controller
{
    public function index()
    {
        $skills = Skill::all();

        return response()->json($skills, 200);
    }

    public function store(SkillsStoreRequest $request)
    {
        $validRequest = $request->validated();

        $skill = new Skill;
        $skill->title = $validRequest['title'];

        $skill->save();
    }

    public function update(SkillsUpdateRequest $request, Skill $skill)
    {
        $validRequest = $request->validated();

        $skill->title = $validRequest['title'];

        $skill->save();
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
    }
}
