<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Group;
use App\Models\Message;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()
        ->count(10)
        ->create();

        $group = Group::factory()
        ->count(4)
        ->create()
        ->each(function($group){
            $users=User::inRandomOrder()->paginate(3);
            foreach($users as $user){
                $group->users()->attach($user->id);
                Message::factory()
                ->count(5)
                ->create();
            }
        });
    }
}
