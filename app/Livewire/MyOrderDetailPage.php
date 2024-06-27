<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

// Set the page title for the MyOrderDetailPage component
#[Title('My Order Details')]
class MyOrderDetailPage extends Component
{
    // Public property to hold the order ID
    public $order_id;

    // The mount method is called when the component is instantiated
    // It sets the order ID property from the route parameter
    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    // The render method is responsible for rendering the component's view
    public function render()
    {
        // Get the authenticated user's ID
        $user_id = Auth::id();

        // Retrieve the order that matches the order ID and belongs to the authenticated user
        // If no such order exists, it will throw a 404 error
        $order = Order::where('id', $this->order_id)
            ->where('user_id', $user_id)
            ->firstOrFail();

        // Retrieve the order items for the specified order ID and load the associated product
        $order_items = OrderItem::with('product')
            ->where('order_id', $this->order_id)
            ->get();

        // Retrieve the address associated with the specified order ID
        $address = Address::where('order_id', $this->order_id)
            ->first();

        // Return the view for the order detail page, passing the order items, address, and order data
        return view('livewire.my-order-detail-page', compact('order_items', 'address', 'order'));
    }
}
