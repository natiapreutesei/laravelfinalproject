<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Fiction',
            'Non-Fiction',
            'Mystery',
            'Fantasy',
            'Science Fiction',
            'Romance',
            'Thriller',
            'Biography',
            'Children\'s',
            'History',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
                'image' => 'https://placehold.co/600x400?text=' . urlencode($category),
                'is_active' => true,
            ]);
        }
    }
}
