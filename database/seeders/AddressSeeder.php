<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AddressSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $orders = Order::all();

        foreach ($orders as $order) {
            Address::create([
                'order_id' => $order->id,
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'street_address' => $faker->streetAddress,
                'city' => $faker->city,
                'state' => $faker->state,
                'zip_code' => $faker->postcode,
            ]);
        }
    }
}
