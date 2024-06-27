<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use function Symfony\Component\Translation\t;

class CartManagement{
    // Adds an item to the cart
    static public function addItemToCart($product_id) {
        // Retrieve existing cart items from the cookie
        $cart_items = self::getCartItemsFromCookie();
        $existing_item = null;

        // Check if the item is already in the cart
        foreach($cart_items as $key => $item) {
            if($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        // If the item exists, increment its quantity
        if($existing_item !== null) {
            $cart_items[$existing_item]['quantity']++;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        } else {
            // If the item does not exist, fetch the product details and add it to the cart
            $product = Product::where('id', $product_id)->first(['id', 'name', 'price', 'image', 'description']);
            if ($product) {
                // Use the first image if multiple images are present
                $image = is_array($product->image) ? $product->image[0] : $product->image;
                // Add the new item to the cart
                $cart_items[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'image' => $image,
                    'description' => $product->description,
                    'quantity' => 1,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price,
                ];
            }
        }
        // Save the updated cart items to the cookie
        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }

    // Adds multiple items to the cart
    static public function addItemsToCart($product_id, $quantity) {
        // Retrieve existing cart items from the cookie
        $cart_items = self::getCartItemsFromCookie();
        $existing_item = null;

        // Check if the item is already in the cart
        foreach($cart_items as $key => $item) {
            if($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        // If the item exists, update its quantity
        if($existing_item !== null) {
            $cart_items[$existing_item]['quantity'] = $quantity;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        } else {
            // If the item does not exist, fetch the product details and add it to the cart
            $product = Product::where('id', $product_id)->first(['id', 'name', 'price', 'image', 'description']);
            if ($product) {
                // Use the first image if multiple images are present
                $image = is_array($product->image) ? $product->image[0] : $product->image;
                // Add the new item to the cart
                $cart_items[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'image' => $image,
                    'description' => $product->description,
                    'quantity' => $quantity,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price * $quantity,
                ];
            }
        }
        // Save the updated cart items to the cookie
        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }

    // Removes an item from the cart
    static public function removeItemFromCart($product_id){
        // Retrieve existing cart items from the cookie
        $cart_items = self::getCartItemsFromCookie();
        // Remove the item from the cart
        foreach($cart_items as $key => $item){
            if($item['product_id'] == $product_id){
                unset($cart_items[$key]);
                break;
            }
        }
        // Save the updated cart items to the cookie
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // Adds cart items to the cookie
    static public function addCartItemsToCookie($cart_items){
        // Save the cart items to a cookie that lasts for 30 days
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }

    // Removes all cart items from the cookie
    static public function removeCartItemsFromCookie(){
        // Remove the cart items cookie
        Cookie::queue(Cookie::forget('cart_items'));
    }

    // Retrieves all cart items from the cookie
    static public function getCartItemsFromCookie(){
        // Get the cart items from the cookie and decode them
        $cart_items = json_decode(Cookie::get('cart_items'), true);
        if (!$cart_items){
            $cart_items = [];
        }
        return $cart_items;
    }

    // Increments the quantity of an item in the cart
    static public function incrementItemQuantity($product_id)
    {
        // Retrieve existing cart items from the cookie
        $cart_items = self::getCartItemsFromCookie();
        // Increment the quantity of the item
        foreach($cart_items as $key => $item){
            if($item['product_id'] == $product_id){
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                break;
            }
        }
        // Save the updated cart items to the cookie
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // Decrements the quantity of an item in the cart
    static public function decrementItemQuantity($product_id){
        // Retrieve existing cart items from the cookie
        $cart_items = self::getCartItemsFromCookie();
        // Decrement the quantity of the item
        foreach($cart_items as $key => $item){
            if($item['product_id'] == $product_id){
                if($item['quantity'] > 1){
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                }
                break;
            }
        }
        // Save the updated cart items to the cookie
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // Calculates the grand total of all items in the cart
    public static function calculateGrandTotal($items)
    {
        // Sum up the total amounts of all items in the cart
        return array_sum(array_column($items, 'total_amount'));
    }
}
