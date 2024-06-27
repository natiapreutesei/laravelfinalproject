<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Component;
use Stripe\Stripe;

#[Title('Checkout')]
class CheckoutPage extends Component
{
    // Public properties for form inputs
    public $phone;
    public $name;
    public $street_address;
    public $city;
    public $state;
    public $zip_code;

    /**
     * Component mount method.
     * This method is called when the component is initialized.
     */
    public function mount()
    {
        // Retrieve cart items from the cookie
        $cart_items = CartManagement::getCartItemsFromCookie();

        // Redirect to the products page if the cart is empty
        if (count($cart_items) == 0) {
            return redirect()->route('products');
        }
    }

    /**
     * Render the component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.checkout-page');
    }

    /**
     * Handle the form submission to place an order.
     */
    public function placeOrder()
    {
        // Validate the form inputs
        $this->validate([
            'phone' => 'required',
            'name' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
        ]);

        // Retrieve cart items from the cookie
        $cart_items = CartManagement::getCartItemsFromCookie();

        // Prepare line items for Stripe Checkout
        $line_items = [];
        foreach ($cart_items as $cart_item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $cart_item['unit_amount'],
                    'product_data' => [
                        'name' => $cart_item['name'],
                    ],
                ],
                'quantity' => $cart_item['quantity'],
            ];
        }

        // Create a new order instance
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->grand_total = CartManagement::calculateGrandTotal($cart_items);
        $order->payment_status = 'pending';
        $order->payment_method = 'stripe';
        $order->status = 'new';
        $order->currency = 'eur';
        $order->shipping_amount = 0;
        $order->shipping_method = 'none';
        $order->notes = 'Order Placed By: ' . auth()->user()->name;

        // Create a new address instance
        $address = new Address();
        $address->name = $this->name;
        $address->street_address = $this->street_address;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->zip_code = $this->zip_code;
        $address->phone = $this->phone;

        // Set Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create a Stripe Checkout session
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => auth()->user()->email,
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cancel'),
        ]);

        // Save the order and address to the database
        $order->save();
        $address->order_id = $order->id;
        $address->save();
        $order->items()->createMany($cart_items);

        // Remove cart items from the cookie
        CartManagement::removeCartItemsFromCookie();

        // Send an order confirmation email
        Mail::to(request()->user())->send(new OrderPlaced($order));

        // Redirect to the Stripe Checkout session URL
        return redirect($session->url);
    }
}
