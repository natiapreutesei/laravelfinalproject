<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            'Penguin Random House',
            'HarperCollins',
            'Simon & Schuster',
            'Hachette Livre',
            'Macmillan Publishers',
            'Scholastic',
            'Pearson Education',
            'McGraw-Hill Education',
            'Wiley',
            'Cengage Learning',
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand,
                'slug' => Str::slug($brand),
                'image' => 'https://placehold.co/600x400?text=' . urlencode($brand),
                'is_active' => true,
            ]);
        }
    }
}
