<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

// Set the page title for the ProductsPage component
#[Title('Products Page')]
class ProductsPage extends Component
{
    // Use pagination trait for handling pagination in the component
    use WithPagination;
    // Use LivewireAlert trait for alert notifications
    use LivewireAlert;

    // Bind properties to URL parameters to maintain state across requests
    #[Url]
    public $selected_categories = [];
    #[Url]
    public $selected_publishers = [];
    #[Url]
    public $featured;
    #[Url]
    public $on_sale;
    #[Url]
    public $price_range = 10;
    #[Url]
    public $sort = 'latest';

    // Method to add a product to the cart
    public function addToCart($product_id)
    {
        // Add item to the cart using CartManagement helper
        $total_count = CartManagement::addItemToCart($product_id);

        // Dispatch an event to update the cart count in the Navbar component
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        // Display a success alert notification
        $this->alert('success', 'Product added to cart!', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    // Method to render the component's view
    public function render()
    {
        // Initialize the product query
        $productQuery = Product::query()->where('is_active', 1);

        // Filter products by selected categories if any
        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        // Filter products by selected publishers if any
        if (!empty($this->selected_publishers)) {
            $productQuery->whereIn('brand_id', $this->selected_publishers);
        }

        // Filter products by featured status if set
        if ($this->featured) {
            $productQuery->where('is_featured', 1);
        }

        // Filter products by on sale status if set
        if ($this->on_sale) {
            $productQuery->where('on_sale', 1);
        }

        // Filter products by price range if set
        if ($this->price_range) {
            $minPrice = $this->price_range * 100;
            $productQuery->where('price', '>=', $minPrice);
        }

        // Sort products by price if sort is set to price
        if ($this->sort == 'price') {
            $productQuery->orderBy('price');
        }

        // Sort products by latest if sort is set to latest
        if ($this->sort == 'latest') {
            $productQuery->latest();
        }

        // Render the view with products, publishers, and categories data
        return view('livewire.products-page', [
            'products' => $productQuery->paginate(9),
            'publishers' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
