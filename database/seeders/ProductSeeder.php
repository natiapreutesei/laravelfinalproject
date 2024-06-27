<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $products = [
            [
                'category_id' => 1,
                'brand_id' => 1,
                'name' => 'The Great Gatsby',
                'slug' => Str::slug('The Great Gatsby'),
                'description' => $faker->paragraph,
                'price' => 1099, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('The Great Gatsby')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => false,
            ],
            [
                'category_id' => 2,
                'brand_id' => 2,
                'name' => 'Sapiens: A Brief History of Humankind',
                'slug' => Str::slug('Sapiens: A Brief History of Humankind'),
                'description' => $faker->paragraph,
                'price' => 1499, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('Sapiens')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => true,
            ],
            [
                'category_id' => 3,
                'brand_id' => 3,
                'name' => 'Gone Girl',
                'slug' => Str::slug('Gone Girl'),
                'description' => $faker->paragraph,
                'price' => 1299, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('Gone Girl')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => false,
            ],
            [
                'category_id' => 4,
                'brand_id' => 4,
                'name' => 'Harry Potter and the Sorcerer\'s Stone',
                'slug' => Str::slug('Harry Potter and the Sorcerer\'s Stone'),
                'description' => $faker->paragraph,
                'price' => 999, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('Harry Potter')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => true,
            ],
            [
                'category_id' => 5,
                'brand_id' => 5,
                'name' => 'Dune',
                'slug' => Str::slug('Dune'),
                'description' => $faker->paragraph,
                'price' => 1399, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('Dune')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => false,
            ],
            [
                'category_id' => 6,
                'brand_id' => 6,
                'name' => 'Pride and Prejudice',
                'slug' => Str::slug('Pride and Prejudice'),
                'description' => $faker->paragraph,
                'price' => 899, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('Pride and Prejudice')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => true,
            ],
            [
                'category_id' => 7,
                'brand_id' => 7,
                'name' => 'The Girl with the Dragon Tattoo',
                'slug' => Str::slug('The Girl with the Dragon Tattoo'),
                'description' => $faker->paragraph,
                'price' => 1199, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('The Girl with the Dragon Tattoo')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => false,
            ],
            [
                'category_id' => 8,
                'brand_id' => 8,
                'name' => 'The Diary of a Young Girl',
                'slug' => Str::slug('The Diary of a Young Girl'),
                'description' => $faker->paragraph,
                'price' => 999, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('The Diary of a Young Girl')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => true,
            ],
            [
                'category_id' => 9,
                'brand_id' => 9,
                'name' => 'Charlotte\'s Web',
                'slug' => Str::slug('Charlotte\'s Web'),
                'description' => $faker->paragraph,
                'price' => 799, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('Charlotte\'s Web')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => false,
            ],
            [
                'category_id' => 10,
                'brand_id' => 10,
                'name' => 'The History of the Ancient World',
                'slug' => Str::slug('The History of the Ancient World'),
                'description' => $faker->paragraph,
                'price' => 1499, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('The History of the Ancient World')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => true,
            ],
            // Additional Products
            [
                'category_id' => 1,
                'brand_id' => 1,
                'name' => 'The Catcher in the Rye',
                'slug' => Str::slug('The Catcher in the Rye'),
                'description' => $faker->paragraph,
                'price' => 999, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('The Catcher in the Rye')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => true,
            ],
            [
                'category_id' => 2,
                'brand_id' => 2,
                'name' => 'Brave New World',
                'slug' => Str::slug('Brave New World'),
                'description' => $faker->paragraph,
                'price' => 1099, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('Brave New World')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => false,
            ],
            [
                'category_id' => 3,
                'brand_id' => 3,
                'name' => '1984',
                'slug' => Str::slug('1984'),
                'description' => $faker->paragraph,
                'price' => 1199, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('1984')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => true,
            ],
            [
                'category_id' => 4,
                'brand_id' => 4,
                'name' => 'To Kill a Mockingbird',
                'slug' => Str::slug('To Kill a Mockingbird'),
                'description' => $faker->paragraph,
                'price' => 1299, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('To Kill a Mockingbird')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => false,
            ],
            [
                'category_id' => 5,
                'brand_id' => 5,
                'name' => 'The Alchemist',
                'slug' => Str::slug('The Alchemist'),
                'description' => $faker->paragraph,
                'price' => 1399, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('The Alchemist')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => true,
            ],
            [
                'category_id' => 6,
                'brand_id' => 6,
                'name' => 'The Road',
                'slug' => Str::slug('The Road'),
                'description' => $faker->paragraph,
                'price' => 899, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('The Road')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => false,
            ],
            [
                'category_id' => 7,
                'brand_id' => 7,
                'name' => 'The Shining',
                'slug' => Str::slug('The Shining'),
                'description' => $faker->paragraph,
                'price' => 1199, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('The Shining')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => true,
            ],
            [
                'category_id' => 8,
                'brand_id' => 8,
                'name' => 'The Hobbit',
                'slug' => Str::slug('The Hobbit'),
                'description' => $faker->paragraph,
                'price' => 999, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('The Hobbit')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => false,
            ],
            [
                'category_id' => 9,
                'brand_id' => 9,
                'name' => 'The Da Vinci Code',
                'slug' => Str::slug('The Da Vinci Code'),
                'description' => $faker->paragraph,
                'price' => 1499, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('The Da Vinci Code')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => true,
            ],
            [
                'category_id' => 10,
                'brand_id' => 10,
                'name' => 'The Lord of the Rings',
                'slug' => Str::slug('The Lord of the Rings'),
                'description' => $faker->paragraph,
                'price' => 1999, // Price in cents
                'image' => ['https://placehold.co/600x400?text=' . urlencode('The Lord of the Rings')],
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
