<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1000)->create()->each(function ($user) {
            $user->jobs()->save(factory(App\Job::class)->make());
            $user->tasks()->save(factory(App\Task::class)->make());
        });
    }
}
