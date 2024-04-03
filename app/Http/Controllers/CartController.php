<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Events;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    // Show Add to Cart Page
    public function ShowCart()
    {
        $user = Auth::user();
        Cart::where('user_id', $user->id)
            ->whereDoesntHave('event', function ($query) {
                $query->whereNull('deleted_at'); // Check in the Event Table if the ticket is deleted Then also delete from cart table
            })->delete();

        $cartItems = Cart::where('user_id', $user->id)
            ->with('event')
            ->get();
        $SubTotal = Cart::where('user_id', $user->id)->sum('total_price');
        $ticket = Cart::where('user_id', $user->id)->sum('quantity');
        $Totalitem = Cart::where('user_id', $user->id)->count();
        return view('userProfile.Cart', compact('cartItems', 'SubTotal', 'ticket', 'Totalitem'));
    }


    // Directly add to cart 
    public function AddtoCart($id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $event = Events::findOrFail($id);
        $price = $event->price;
        $organizer_id = $event->organizer_id;
        //  Check if the item is already in the user's cart, then update quantity else create a new one
        $cartItem = Cart::where('user_id', $user_id)
            ->where('event_id', $id)
            ->first();
        if ($cartItem) {
            $cartItem->increment('quantity');
            $cartItem->update([
                'total_price' => $cartItem->quantity * $price,
            ]);
            // if the ticket is not already in cart then create it with default 1 quantity  and total price as price
        } else {
            Cart::create([
                'user_id' => $user_id,
                'event_id' => $id,
                'organizer_id' => $organizer_id,
                'quantity' => 1,
                'price' => $price,
                'total_price' => $price,
            ]);
        }

        return redirect()->back()->with('success', 'Added to Cart!');
    }

    // Delete the item from cart
    public function DeleteFromCart($id)
    {
        Cart::where("id", $id)->delete();
        return redirect()->back()->with("error", "Deleted from Cart!");
    }

    // Place the order from the cart table
    public function CheckOutOrder(Request $request)
    {

        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();
        // Retrieve the payment intent id from the request
        $paymentIntentId = $request->input('payment_intent');
        Log::debug('Trasntions id' . $paymentIntentId);
        // Create orders for each cart item
        foreach ($cartItems as $item) {
            Order::create([
                'user_id' => $item->user_id,
                'event_id' => $item->event_id,
                'organizer_id' => $item->organizer_id,
                'quantity' => $item->quantity,
                'price' => $item->event->price,
                'total_price' => $item->total_price,
                'transaction_id' => $paymentIntentId,
            ]);
        }

        // Aftre the Checkout Cart will be empty and stroe the data in the order table.
        Cart::where('user_id', $user->id)->delete();

        return redirect('/cart')->with('success', 'Your Order is Placed !!');
        // return redirect()->back()->with('success', 'Your Order is Placed !!');
    }

    public function paymentGateway()
    {
        // Set your Stripe API key.
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $user = Auth::user();
        $email = $user->email;
        $SubTotal = Cart::where('user_id', $user->id)->sum('total_price');
        $ticket = Cart::where('user_id', $user->id)->sum('quantity');
        $eventNames = Cart::where('user_id', $user->id)->with('event')->get();
        $description = 'Purchase ' . $ticket . ' ticket(s) for ';
        foreach ($eventNames as $eventName) {
            $description .= $eventName->event->name . ', ';
        }

        // Create a Payment Intent
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $SubTotal * 100, // Amount in cents
            'currency' => 'INR',
            'description' => 'Payment for BookMyTicket.com',
            'metadata' => [
                'user_id' => $user->id,
                'email' => $email,
            ],
        ]);

        $paymentGateway = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'INR',
                        'product_data' => [
                            'name' => 'BookMyTicket.com',
                            'description' => $description,

                        ],
                        'unit_amount' => $SubTotal * 100, // Convert to cents
                    ],
                    'quantity' => 1,
                ],
            ],
            'customer_email' => $email, // Add customer's email
            'billing_address_collection' => 'required', // Request customer's billing address
            'mode' => 'payment',
            'success_url' => route('CheckOutOrder') . '?payment_intent=' . $paymentIntent->id,
            'cancel_url' => route('cart'),
        ]);
        return redirect()->away($paymentGateway->url);
    }


    // Increase the quantity of the item in the cart page
    public function increaseQuantity($id)
    {
        $user = Auth::user();
        // Get the id of the item from the cart table and increament by 1 
        $cart = Cart::where('id', $id)->first();
        $cart->increment('quantity');
        $cart->update(['total_price' => $cart->quantity * $cart->price,]);
        // Aftre the the changes it will get the total price and ticket and sent all data to the view using json
        $SubTotal = Cart::where('user_id', $user->id)->sum('total_price');
        $ticket = Cart::where('user_id', $user->id)->sum('quantity');
        return response()->json([
            'quantity' => $cart->quantity,
            'SubTotal' => $SubTotal,
            'ticket' => $ticket
        ]);
    }

    // Decrease the quantity of the item in the cart page 
    public function decreaseQuantity($id)
    {
        $user = Auth::user();
        $cart = Cart::where('id', $id)->first();

        // if the the quanitity is less than 1 than it will delete the item from the cart.
        if ($cart->quantity <= 1) {
            return response()->json(['delete' => true]);
        } else {
            $cart->decrement('quantity');
            $cart->update(['total_price' => $cart->quantity * $cart->price]);
            $SubTotal = Cart::where('user_id', $user->id)->sum('total_price');
            $ticket = Cart::where('user_id', $user->id)->sum('quantity');
            return response()->json([
                'quantity' => $cart->quantity,
                'SubTotal' => $SubTotal,
                'ticket' => $ticket
            ]);
        }
    }
}
