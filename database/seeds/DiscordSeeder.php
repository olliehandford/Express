<?php

use Illuminate\Database\Seeder;
use App\Discord;

class DiscordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            Discord::create([
                'id' => rand(1000000000,2147000000),
                'user_id' => $i,
                'username' => $faker->username(),
                'avatar' => 'https://cdn.discordapp.com/avatars/' . rand(1000000000,2147000000) . '/' . str_random(48) . '.jpg',
                'refresh_token' => str_random(20),
                'access_token' => str_random(20)
            ]);
        }
    }
}
