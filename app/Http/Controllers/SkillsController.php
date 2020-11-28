<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillsUpdateRequest;
use App\Http\Requests\SkillsStoreRequest;
use App\Http\Resources\SkillResource;
use App\Models\Skill;

class SkillsController extends Controller
{
    public function index()
    {
        $skills = SkillResource::collection(Skill::all());

        return response()->json(compact('skills'), 200);
    }

    public function show(Skill $skill)
    {
        $skillResource = new SkillResource($skill);

        return response()->json(['skill' => $skillResource], 200);
    }

    public function store(SkillsStoreRequest $request)
    {
        $validRequest = $request->validated();

        $skill = new Skill;
        $skill->title = $validRequest['title'];

        $skill->save();

        $message = "Skill {$skill->title} saved";
        return response()->json(compact('message'), 200);
    }

    public function update(SkillsUpdateRequest $request, Skill $skill)
    {
        $validRequest = $request->validated();

        $skill->title = $validRequest['title'];

        $skill->save();

        $message = "Skill {$skill->title} updated";
        return response()->json(compact('message'), 200);
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        $message = "Skill {$skill->title} deleted";
        return response()->json(compact('message'), 200);
    }
}
