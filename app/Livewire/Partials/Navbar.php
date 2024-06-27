<?php
namespace App\Livewire\Partials;

use App\Helpers\CartManagement;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    // Property to hold the total count of items in the cart
    public $total_count = 0;

    /**
     * Lifecycle hook that runs when the component is mounted.
     * It initializes the total_count property with the count of items in the cart.
     */
    public function mount()
    {
        // Retrieve the count of items from the cart stored in cookies
        $this->total_count = count(CartManagement::class::getCartItemsFromCookie());
    }

    /**
     * Method to handle the 'update-cart-count' event.
     * It updates the total_count property with the provided value.
     *
     * @param int $total_count The new total count of items in the cart.
     */
    #[On('update-cart-count')]
    public function updateCartCount($total_count)
    {
        // Update the total count with the new value received from the event
        $this->total_count = $total_count;
    }

    /**
     * Render the view for the Livewire component.
     *
     * @return \Illuminate\View\View The view for the navbar component.
     */
    public function render()
    {
        // Return the view for the navbar component
        return view('livewire.partials.navbar');
    }
}
