<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();

        foreach ($users as $user) {
            Order::create([
                'user_id' => $user->id,
                'grand_total' => $faker->numberBetween(1000, 5000),
                'payment_method' => 'stripe',
                'payment_status' => 'paid',
                'status' => 'new',
                'currency' => 'USD',
                'shipping_amount' => $faker->numberBetween(500, 1500),
                'shipping_method' => 'DHL',
                'notes' => $faker->sentence,
            ]);
        }
    }
}
