<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Faker\Factory;

class UsersController extends Controller
{
    public function index()
    {
        return $this->returnDummyUsers();
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
}
