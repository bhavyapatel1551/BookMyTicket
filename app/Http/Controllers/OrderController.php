<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function UserPurchaseOrder()                                     // Show user's purchased ticket order list
    {
        $user_id = Auth::id();                                              // get current user's info

        $orders = Order::where('user_id', $user_id)->with('event')->orderByDesc('created_at')->paginate(10);
        return view('tickets.UserTicketOrder', compact('orders'));
    }

    public function OrganizerOrderDetails()                                // show all Statistics related to organizer's events
    {
        $user_id = Auth::id();                                             // Get current user's info

        // Fetch all data like Related to sales and revenue
        $orders = Order::where('organizer_id', $user_id)->with('event', 'user')->orderByDesc('created_at')->paginate();
        $Totalsale = Order::where('organizer_id', $user_id)->sum('quantity');
        $Todaysale = Order::where('organizer_id', $user_id)->whereDate('created_at', Carbon::today())->sum('quantity');
        $Totalprice = Order::where('organizer_id', $user_id)->sum('total_price');
        $Todayprice = Order::where('organizer_id', $user_id)->whereDate('created_at', Carbon::today())->sum('total_price');
        return view('events.EventStatistic', compact('orders', 'Totalsale', 'Totalprice', 'Todaysale', 'Todayprice'));
    }

    public function TodaySales()                                          // Show today's sales page for organizer
    {
        $user_id = Auth::id();                                           // get current user's info

        $orders = Order::where('organizer_id', $user_id)->whereDate('created_at', Carbon::today())->with('event', 'user')->orderByDesc('created_at')->paginate(10);
        $Totalsale = Order::where('organizer_id', $user_id)->sum('quantity');
        $Todaysale = Order::where('organizer_id', $user_id)->whereDate('created_at', Carbon::today())->sum('quantity');
        $Totalprice = Order::where('organizer_id', $user_id)->sum('total_price');
        $Todayprice = Order::where('organizer_id', $user_id)->whereDate('created_at', Carbon::today())->sum('total_price');
        return view('events.Todaysale', compact('orders', 'Totalsale', 'Totalprice', 'Todaysale', 'Todayprice'));
    }

    public function PurchasedTicket($id)                                // Show purchased ticket of user
    {
        $user_id = Auth::id();                                          // get current user's info
        $orders = Order::where('id', $id)->first();
        // if the ticket is purchased by authorized user then it will show ticket
        $check = $orders->user_id == $user_id;
        if ($check) {
            $ticket = Order::where('id', $id)->with('event')->first();
            return view('tickets.PurchasedTicket', compact('ticket'));
        } else {
            abort(403, 'Unauthorized');
        }
    }
}
