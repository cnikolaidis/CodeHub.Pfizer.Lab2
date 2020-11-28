<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillsUpdateRequest;
use App\Http\Requests\SkillsStoreRequest;
use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Exception;

class SkillsController extends Controller
{
    public function index()
    {
        try
        {
            $skills = SkillResource::collection(Skill::all());

            return response()->json(compact('skills'), 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }

    public function show(Skill $skill)
    {
        try
        {
            $skillResource = new SkillResource($skill);

            return response()->json(['skill' => $skillResource], 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }

    public function store(SkillsStoreRequest $request)
    {
        try
        {
            $validRequest = $request->validated();

            $skill = new Skill;
            $skill->title = $validRequest['title'];

            $skill->save();

            $message = "Skill {$skill->title} saved";
            return response()->json(compact('message'), 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }

    public function update(SkillsUpdateRequest $request, Skill $skill)
    {
        try
        {
            $validRequest = $request->validated();

            $skill->title = $validRequest['title'];

            $skill->save();

            $message = "Skill {$skill->title} updated";
            return response()->json(compact('message'), 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }

    public function destroy(Skill $skill)
    {
        try
        {
            $skill->delete();

            $message = "Skill {$skill->title} deleted";
            return response()->json(compact('message'), 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }
}
