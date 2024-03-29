<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function UserPurchaseOrder()
    {
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->with('event')->orderByDesc('created_at')->get();
        return view('tickets.UserTicketOrder', compact('orders'));
    }

    public function OrganizerOrderDetails()
    {
        $user_id = Auth::id();
        $orders = Order::where('organizer_id', $user_id)->with('event', 'user')->orderByDesc('created_at')->get();
        $Totalsale = Order::where('organizer_id', $user_id)->sum('quantity');
        $Todaysale = Order::where('organizer_id', $user_id)->whereDate('created_at', Carbon::today())->sum('quantity');
        $Totalprice = Order::where('organizer_id', $user_id)->sum('total_price');
        $Todayprice = Order::where('organizer_id', $user_id)->whereDate('created_at', Carbon::today())->sum('total_price');
        return view('events.EventStatistic', compact('orders', 'Totalsale', 'Totalprice', 'Todaysale', 'Todayprice'));
    }
}
