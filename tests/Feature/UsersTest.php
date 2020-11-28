<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Faker\Factory;

class UsersTest extends TestCase
{
    public function testIndexSuccess()
    {
        $response = $this->getJson('/api/users');

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['users' => []]);
    }

    public function testIndexFails()
    {
        $response = $this->getJson('/api/user');

        $response
            ->assertStatus(400)
            ->assertJsonStructure(['error']);
    }

    public function testShowSuccess()
    {
        $userId = User::all()->random(1)->first()->id;
        $response = $this->getJson("/api/users/{$userId}");

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['user' => ['departmentId']]);
    }

    public function testShowFails()
    {
        $response = $this->getJson('/api/users/0');

        $response
            ->assertStatus(400)
            ->assertJsonStructure(['error' => []]);
    }

    public function testStoreSuccess()
    {
        $faker = Factory::create();
        $response = $this->postJson('/api/users',
            [
                'firstName' => $faker->firstName,
                'lastName' => $faker->lastName,
                'email' => $faker->email,
                'password' => $faker->password
            ]);

        $response
            ->assertStatus(200)
            ->assertJsonPath('message', 'User was saved');
    }

    public function testStoreFails()
    {
        $response = $this->postJson('/api/users', [ 'firstName' => '', 'lastName' => '', 'email' => '', 'password' => '' ]);

        $response
            ->assertStatus(400)
            ->assertJsonPath('error', 'The given data was invalid.');
    }

    public function testUpdateSuccess()
    {
        $faker = Factory::create();
        $userId = User::all()->random(1)->first()->id;
        $response = $this->putJson("/api/users/{$userId}",
            [
                'firstName' => $faker->firstName,
                'lastName' => $faker->lastName,
                'email' => $faker->email
            ]);

        $response
            ->assertStatus(200)
            ->assertJsonPath('message', 'User was updated');
    }

    public function testUpdateFails()
    {
        $userId = User::all()->random(1)->first()->id;
        $response = $this->putJson("/api/users/{$userId}", [ 'firstName' => '', 'lastName' => '', 'email' => '' ]);

        $response
            ->assertStatus(400)
            ->assertJsonPath('error', 'The given data was invalid.');
    }

    public function testDestroySuccess()
    {
        $userId = User::all()->random(1)->first()->id;
        $response = $this->deleteJson("/api/users/{$userId}");

        $response
            ->assertStatus(200)
            ->assertJsonPath('message', 'User was deleted');
    }

    public function testDestroyFails()
    {
        $response = $this->deleteJson('/api/users/0');

        $response
            ->assertStatus(400)
            ->assertJsonStructure(['error']);
    }
}
