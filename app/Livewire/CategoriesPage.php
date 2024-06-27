<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

class CategoriesPage extends Component
{
    // Set the page title to 'Categories'
    #[Title('Categories')]

    /**
     * Render the Livewire component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // Retrieve all active brands (publishers) from the database
        $publishers = Brand::where('is_active', 1)->get();

        // Retrieve all active categories from the database
        $categories = Category::where('is_active', 1)->get();

        // Return the view for the categories page, passing the retrieved brands and categories
        return view('livewire.categories-page', compact('categories', 'publishers'));
    }
}
