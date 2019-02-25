<?php

use Illuminate\Database\Seeder;
use App\Keys;
use Carbon\Carbon;

class KeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Keys::query()->delete();


        $key = strtoupper(str_random(5) . "-" . str_random(5) . "-" . str_random(5) . "-" . str_random(5) . "-" . str_random(5));

        Keys::create([
            'user_id' => 1,
            'activation_key' => $key,
            'activated_at' => null,
            'expires_on' => Carbon::parse('2019-05-05'),
            'key_type' => 'monthly',
            'generated_by' => 5
        ]);
    }
}
