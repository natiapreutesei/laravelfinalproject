<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderItemSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $orders = Order::all();
        $products = Product::all();

        foreach ($orders as $order) {
            foreach ($products->random(2) as $product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $faker->numberBetween(1, 5),
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price * $faker->numberBetween(1, 5),
                ]);
            }
        }
    }
}
