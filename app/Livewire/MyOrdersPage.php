<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

// Set the page title for the MyOrdersPage component
#[Title('My Orders')]
class MyOrdersPage extends Component
{
    // Use the WithPagination trait to enable pagination in the Livewire component
    use WithPagination;

    // The render method is responsible for rendering the component's view
    public function render()
    {
        // Retrieve the orders for the authenticated user, order them by the latest, and paginate the results
        $my_orders = Order::where('user_id', auth()->user()->id)->latest()->paginate(10);

        // Return the view for the orders page, passing the paginated orders data
        return view('livewire.my-orders-page', compact('my_orders'));
    }
}
