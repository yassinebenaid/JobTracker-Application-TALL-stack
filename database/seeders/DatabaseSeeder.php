<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Roles;
use App\Models\Job;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(40)->create();

        Skill::factory(50)->create();


        foreach (User::where("id", ">=", 2)->get() as $user) {
            $user->assignRole(Roles::ENTREPRENEUR->value);
        }

        Job::factory(6000)->create();

        foreach (Job::all() as $job) {
            foreach (Skill::inRandomOrder()->take(5)->get() as $skill) {
                $job->skills()->attach($skill->id);
            }
        }

        Profile::factory(40)->create();
    }
}
