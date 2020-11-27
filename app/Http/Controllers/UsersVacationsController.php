<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersVacationsUpdateRequest;
use App\Http\Requests\UsersVacationsStoreRequest;
use App\Models\Vacation;
use App\Models\User;

class UsersVacationsController extends Controller
{
    public function index(User $user)
    {
        return response()->json($user->vacations, 200);
    }

    public function store(User $user, UsersVacationsStoreRequest $request)
    {
        $validRequest = $request->validated();
        $vacationsArray = $validRequest['vacations'];

        foreach ($vacationsArray as $vObj)
        {
            $vObj->userId = $user->id;
            $vObj->save();
        }
    }

    public function show(User $user, Vacation $vacation)
    {
        return response()->json($vacation, 200);
    }

    public function update(UsersVacationsUpdateRequest $request, Vacation $vacation)
    {
        $validRequest = $request->validated();

        $vacation->from = $validRequest['from'];
        $vacation->to = $validRequest['to'];

        $vacation->save();
    }

    public function destroy(Vacation $vacation)
    {
        $vacation->delete();
    }
}
