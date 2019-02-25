<?php

use Illuminate\Database\Seeder;
use App\Payments;
use App\Subscriptions;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payments::query()->delete();
        Subscriptions::query()->delete();

        $faker = \Faker\Factory::create();

        $profiles = array();

        for ($i = 0; $i < 10; $i++) {

            $profile = [
                'subscription_id' => str_random(12),
                'customer_id' => str_random(10),
                'user_id' => rand(1,15),
                'payer_name' => $faker->name(),
                'payer_email' => $faker->email()
            ];

            array_push($profiles, $profile);
            
            Subscriptions::create([
                'id' => $profile['subscription_id'],
                'user_id' =>  $profile['user_id'],
                'customer_id' => $profile['customer_id'],
                'status' => 'ACTIVE',
            ]);

        }

        for ($i = 0; $i < 50; $i++) {

            $profile = $profiles[rand(0,9)];

            Payments::create([
                'subscription_id' => $profile['subscription_id'],
                'amount' => '30.00',
                'payer_name' => $profile['payer_name'],
                'payer_email' => $profile['payer_email']
            ]);
        }
    }
}
