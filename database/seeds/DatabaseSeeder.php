<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SitesSeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(KeySeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(DiscordSeeder::class);
    }
}
