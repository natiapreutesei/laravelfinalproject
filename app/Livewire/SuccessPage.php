<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;

// Set the page title for the SuccessPage component
#[Title('Success')]
class SuccessPage extends Component
{
    // Bind the session_id property to the URL parameter
    #[Url]
    public $session_id;

    // Method to render the component's view
    public function render()
    {
        // Retrieve the latest order for the authenticated user
        $latest_order = Order::with('address')->where('user_id', auth()->user()->id)->latest()->first();

        // Check if the session_id URL parameter is set
        if($this->session_id){
            // Set the Stripe API key from the environment variable
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Retrieve the session information from Stripe
            $session_info = Session::retrieve($this->session_id);

            // Check the payment status in the session information
            if ($session_info->payment_status !== 'paid') {
                // If the payment status is not 'paid', mark the latest order as 'failed'
                $latest_order->payment_status = 'failed';
                $latest_order->save();

                // Redirect to the cancel route
                return redirect()->route('cancel');
            } else if ($session_info->payment_status === 'paid') {
                // If the payment status is 'paid', mark the latest order as 'paid'
                $latest_order->payment_status = 'paid';
                $latest_order->save();
            }
        }

        // Render the view with the latest order data
        return view('livewire.success-page', compact('latest_order'));
    }
}
