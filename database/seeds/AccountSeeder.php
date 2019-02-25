<?php

use Illuminate\Database\Seeder;
use App\User;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Empty table
        User::query()->delete();

        $faker = \Faker\Factory::create();

        User::create([
            'name' => 'Conor Reid',
            'email' => 'conorreidd@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'api_token' => str_random(48)
        ]);

        for ($i = 0; $i < 50; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'role' => 'user',
                'api_token' => str_random(48),
                'password' => Hash::make($faker->password())
            ]);
        }
    }
}
