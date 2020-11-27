<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersUpdateRequest;
use App\Http\Requests\UsersStoreRequest;
use App\Models\User;
use Faker\Factory;

class UsersController extends Controller
{
    public function index()
    {
        $users = $this->returnRealUsers();

        return response()->json($users, 200);
    }

    public function show(User $user)
    {
        return $user;
    }

    public function store(UsersStoreRequest $request)
    {
        $validRequest = $request->validated();

        $user = new User;
        $user->firstName = $validRequest['firstName'];
        $user->lastName = $validRequest['lastName'];
        $user->email = $request['email'];
        $user->password = $request['password'];

        $user->save();
    }

    public function update(UsersUpdateRequest $request, User $user)
    {
        $validRequest = $request->validated();

        $user->firstName = $validRequest['firstName'];
        $user->lastName = $validRequest['lastName'];
        $user->email = $validRequest['email'];

        $user->save();
    }

    public function destroy(User $user)
    {
        $user->delete();
    }

    private function returnUsers()
    { return "users"; }

    private function returnDummyUsers()
    {
        $users = [];
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++)
        {
            $user = new User();
            $user['firstName'] = $faker->firstName;
            $user['lastName'] = $faker->lastName;
            $user['email'] = $faker->email;
            $user['password'] = $faker->password;

            array_push($users, $user);
        }

        return [
            'users' => $users,
            'total' => count($users)
        ];
    }

    private function returnRealUsers()
    {
        $users = User::all();

        return [
            'users' => $users,
            'total' => count($users)
        ];
    }
}
