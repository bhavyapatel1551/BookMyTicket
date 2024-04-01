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
        $SubTotal = Cart::sum('total_price');
        $ticket = Cart::sum('quantity');
        $TotalItem = Cart::sum('user_id');
        return view('userProfile.Cart', compact('cartItems', 'SubTotal', 'ticket', 'TotalItem'));
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
    public function CheckOutOrder($id)
    {
        $cartItems = Cart::where('user_id', $id)->get();

        // Create orders for each cart item
        foreach ($cartItems as $item) {
            Order::create([
                'user_id' => $item->user_id,
                'event_id' => $item->event_id,
                'organizer_id' => $item->organizer_id,
                'quantity' => $item->quantity,
                'price' => $item->event->price, // Assuming event price is stored in the event table
                'total_price' => $item->total_price,
                // Add other order details as needed
            ]);
        }

        // Delete cart items associated with the user
        Cart::where('user_id', $id)->delete();

        return redirect()->back()->with('success', 'Your Order is Placed !!');
    }

    public function increaseQuantity($id)
    {
        $cart = Cart::where('id', $id)->first();
        $cart->increment('quantity');
        $cart->update(['total_price' => $cart->quantity * $cart->price,]);
        $SubTotal = Cart::sum('total_price');
        $ticket = Cart::sum('quantity');
        return response()->json([
            'quantity' => $cart->quantity,
            'SubTotal' => $SubTotal,
            'ticket' => $ticket
        ]);
    }
    public function decreaseQuantity($id)
    {
        $cart = Cart::where('id', $id)->first();

        if ($cart->quantity <= 1) {
            return response()->json(['delete' => true]);
        } else {
            $cart->decrement('quantity');
            $cart->update(['total_price' => $cart->quantity * $cart->price]);
            $SubTotal = Cart::sum('total_price');
            $ticket = Cart::sum('quantity');
            return response()->json([
                'quantity' => $cart->quantity,
                'SubTotal' => $SubTotal,
                'ticket' => $ticket
            ]);
        }
    }
}
