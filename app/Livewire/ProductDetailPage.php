<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

// Set the page title for the ProductDetailPage component
#[Title('Product Detail')]
class ProductDetailPage extends Component
{
    // Use the LivewireAlert trait for alert notifications
    use LivewireAlert;

    // Public properties to hold the slug of the product and the quantity of the product to add to the cart
    public $slug;
    public $quantity = 1;

    // The mount method is called when the component is initialized, setting the slug property from the route parameter
    public function mount($slug)
    {
        $this->slug = $slug;
    }

    // Method to decrement the quantity, ensuring it doesn't go below 1
    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    // Method to increment the quantity
    public function incrementQuantity()
    {
        $this->quantity++;
    }

    // Method to add the product to the cart
    public function addToCart($product_id)
    {
        // Add items to the cart using the CartManagement helper and get the total count of items in the cart
        $total_count = CartManagement::addItemsToCart($product_id, $this->quantity);

        // Dispatch an event to update the cart count in the Navbar component
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        // Display a success alert notification
        $this->alert('success', 'Product added to cart!', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    // The render method is responsible for rendering the component's view
    public function render()
    {
        // Retrieve the product using the slug and pass it to the view
        return view('livewire.product-detail-page', [
            'product' => Product::where('slug', $this->slug)->firstOrFail(),
        ]);
    }
}
