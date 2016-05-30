<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i++) {
            User::create([
                'name' => $faker->name(),
                'cosplayer_name' => $faker->name(),
                'email' => $faker->email(),
                'password' => bcrypt('a')
            ]);
        }
    }
}
