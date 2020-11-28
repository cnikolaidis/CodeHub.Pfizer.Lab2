<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\User;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = Department::factory()->times(5)->has(User::factory())->create();
        $users = User::all();

        $users->each(function ($user) use ($departments)
        {
            $dId = $departments->random(1)->id;
            $user->update(['departmentId' => $dId]);
        });
    }
}
