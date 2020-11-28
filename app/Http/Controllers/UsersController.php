<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersUpdateRequest;
use App\Http\Requests\UsersStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;

class UsersController extends Controller
{
    public function index()
    {
        try
        {
            $users = UserResource::collection(User::all());
            $count = count($users);

            return response()->json(compact('users', 'count'), 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }

    public function show(User $user)
    {
        try
        {
            $userResource = new UserResource($user);

            return response()->json(['user' => $userResource]);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }

    public function store(UsersStoreRequest $request)
    {
        try
        {
            $validRequest = $request->validated();

            $user = new User;
            $user->firstName = $validRequest['firstName'];
            $user->lastName = $validRequest['lastName'];
            $user->email = $request['email'];
            $user->password = $request['password'];

            $user->save();

            $message = "User was saved";
            return response()->json(compact('message'), 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }

    public function update(UsersUpdateRequest $request, User $user)
    {
        try
        {
            $validRequest = $request->validated();

            $user->firstName = $validRequest['firstName'];
            $user->lastName = $validRequest['lastName'];
            $user->email = $validRequest['email'];

            $user->save();

            $message = "User was updated";
            return response()->json(compact('message'), 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }

    public function destroy(User $user)
    {
        try
        {
            $user->delete();

            $message = "User was deleted";
            return response()->json(compact('message'), 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }
}
