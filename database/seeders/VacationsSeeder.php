<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vacation;
use App\Models\User;

class VacationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function ($user)
        {
            Vacation::factory(2)->create()->each(function ($v) use ($user)
            {
                $v->userId = $user->id;
                $user->vacations()->save($v);
            });
        });
    }
}
