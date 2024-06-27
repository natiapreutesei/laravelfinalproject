<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

class HomePage extends Component
{
    // Sets the title attribute for the page
    #[Title('Home Page')]
    public function render()
    {
        // Retrieve all active categories from the database
        $categories = Category::where('is_active', 1)->get();

        // Retrieve all featured products from the database
        $products = Product::where('is_featured', 1)->get();

        // Return the view for the home page, passing the categories and products data
        return view('livewire.home-page', compact('categories', 'products'));
    }
}
