<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = Skill::all();
        User::factory(10)->create()->each(function ($user) use ($skills)
        { $user->skills()->saveMany($skills); });
    }
}
