<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersVacationsUpdateRequest;
use App\Http\Requests\UsersVacationsStoreRequest;
use App\Http\Resources\UserVacationsResource;
use App\Http\Resources\VacationResource;
use App\Models\Vacation;
use App\Models\User;
use Exception;

class UsersVacationsController extends Controller
{
    public function index(User $user)
    {
        try
        {
            $userVacations = new UserVacationsResource($user);

            return response()->json(['userVacations' => $userVacations], 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }

    public function store(User $user, UsersVacationsStoreRequest $request)
    {
        try
        {
            $validRequest = $request->validated();
            $vacationsArray = $validRequest['vacations'];

            foreach ($vacationsArray as $vObj)
            {
                $vacation = new Vacation;
                $vacation->userId = $user->id;
                $vacation->from = $vObj['from'];
                $vacation->to = $vObj['to'];

                $vacation->save();
            }

            $message = "Vacations saved for user {$user->fullName}";
            return response()->json(compact('message'), 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }

    public function show(User $user, Vacation $vacation)
    {
        try
        {
            if (count($user->vacations) < 1)
                return response()->json(['message' => "User {$user->fullName} has no vacations"], 400);

            return response()->json(['vacation' => new VacationResource($vacation)], 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }

    public function update(UsersVacationsUpdateRequest $request, User $user, Vacation $vacation)
    {
        try
        {
            $validRequest = $request->validated();

            $vacation->from = $validRequest['from'];
            $vacation->to = $validRequest['to'];

            $vacation->save();

            $message = "Vacation updated for user {$user->fullName}";
            return response()->json(compact('message'), 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }

    public function destroy(User $user, Vacation $vacation)
    {
        try
        {
            $vacation->delete();

            $message = "Vacation deleted for user {$user->fullName}";
            return response()->json(compact('message'), 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }
}
