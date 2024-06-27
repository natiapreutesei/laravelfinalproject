<?php
namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Cart')]
class CartPage extends Component
{
    // Property to hold cart items
    public $cart_items = [];

    // Property to hold the grand total amount
    public $grand_total;

    /**
     * Lifecycle hook that runs when the component is mounted.
     * It initializes the cart items and grand total properties.
     */
    public function mount()
    {
        // Retrieve the cart items from cookies
        $this->cart_items = CartManagement::class::getCartItemsFromCookie();

        // Calculate the grand total amount
        $this->grand_total = CartManagement::class::calculateGrandTotal($this->cart_items);
    }

    /**
     * Method to remove an item from the cart.
     * Updates the cart items and grand total properties, and dispatches an event to update the cart count.
     *
     * @param int $product_id The ID of the product to remove from the cart.
     */
    public function removeItem($product_id)
    {
        // Remove the item from the cart
        $this->cart_items = CartManagement::class::removeItemFromCart($product_id);

        // Recalculate the grand total amount
        $this->grand_total = CartManagement::class::calculateGrandTotal($this->cart_items);

        // Dispatch an event to update the cart count in the navbar
        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
    }

    /**
     * Method to increment the quantity of an item in the cart.
     * Updates the cart items and grand total properties.
     *
     * @param int $product_id The ID of the product to increment the quantity of.
     */
    public function incrementItemQuantity($product_id)
    {
        // Increment the item quantity in the cart
        $this->cart_items = CartManagement::incrementItemQuantity($product_id);

        // Recalculate the grand total amount
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    /**
     * Method to decrement the quantity of an item in the cart.
     * Updates the cart items and grand total properties.
     *
     * @param int $product_id The ID of the product to decrement the quantity of.
     */
    public function decrementItemQuantity($product_id)
    {
        // Decrement the item quantity in the cart
        $this->cart_items = CartManagement::decrementItemQuantity($product_id);

        // Recalculate the grand total amount
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    /**
     * Render the view for the Livewire component.
     *
     * @return \Illuminate\View\View The view for the cart page component.
     */
    public function render()
    {
        // Return the view for the cart page component
        return view('livewire.cart-page');
    }
}
