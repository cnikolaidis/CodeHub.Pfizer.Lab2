<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $user = new User;
        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        $user->save();
    }

    public function update(Request $request, User $user)
    {
        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->email = $request->input('email');

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
