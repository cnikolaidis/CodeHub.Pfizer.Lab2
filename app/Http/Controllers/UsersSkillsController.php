<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersSkillsStoreRequest;
use App\Http\Resources\UserSkillResource;
use App\Models\UsersSkills;
use App\Models\User;

class UsersSkillsController extends Controller
{
    public function index(User $user)
    {
        $userSkillsResource = new UserSkillResource($user);

        return response()->json(['userSkills' => $userSkillsResource], 200);
    }

    public function store(User $user, UsersSkillsStoreRequest $request)
    {
        $validRequest = $request->validated();
        $skillsArray = $validRequest['skills'];

        foreach ($skillsArray as $skillObj)
        {
            $userSkill = new UsersSkills;
            $userSkill->userId = $user->id;
            $userSkill->skillId = $skillObj;

            $userSkill->save();
        }

        $message = "Skills saved for user {$user->fullName}";
        return response()->json(compact('message'), 200);
    }
}
