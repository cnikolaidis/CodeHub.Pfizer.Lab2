<?php

namespace App\Http\Controllers;

use App\Models\User;
use Faker\Factory;

class UsersController extends Controller
{
    public function index()
    {
        $users = $this->returnRealUsers();

        return response()->json($users, 200);
    }

    public function show($id)
    {
        return User::findOrFail($id);
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
