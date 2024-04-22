<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Show user's purchesed ticket order list page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function UserPurchaseOrder()
    {
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->with('event')->orderByDesc('created_at')->paginate(10);
        return view('tickets.UserTicketOrder', compact('orders'));
    }

    /**
     * Show Statistics Page to organizer's event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function OrganizerOrderDetails()
    {
        $user_id = Auth::id();

        /**
         * Fetch all data like Total/today's sales and revenue 
         */
        $orders = Order::where('organizer_id', $user_id)->with('event', 'user')->orderByDesc('created_at')->paginate();
        $Totalsale = Order::where('organizer_id', $user_id)->sum('quantity');
        $Todaysale = Order::where('organizer_id', $user_id)->whereDate('created_at', Carbon::today())->sum('quantity');
        $Totalprice = Order::where('organizer_id', $user_id)->sum('total_price');
        $Todayprice = Order::where('organizer_id', $user_id)->whereDate('created_at', Carbon::today())->sum('total_price');
        return view('events.EventStatistic', compact('orders', 'Totalsale', 'Totalprice', 'Todaysale', 'Todayprice'));
    }

    /**
     * Show today's sales page for organizer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function TodaySales()
    {
        $user_id = Auth::id();
        $orders = Order::where('organizer_id', $user_id)->whereDate('created_at', Carbon::today())->with('event', 'user')->orderByDesc('created_at')->paginate(10);
        $Totalsale = Order::where('organizer_id', $user_id)->sum('quantity');
        $Todaysale = Order::where('organizer_id', $user_id)->whereDate('created_at', Carbon::today())->sum('quantity');
        $Totalprice = Order::where('organizer_id', $user_id)->sum('total_price');
        $Todayprice = Order::where('organizer_id', $user_id)->whereDate('created_at', Carbon::today())->sum('total_price');
        return view('events.Todaysale', compact('orders', 'Totalsale', 'Totalprice', 'Todaysale', 'Todayprice'));
    }

    /**
     * Show purchesed ticket of user
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function PurchasedTicket($id)
    {
        $user_id = Auth::id();
        $orders = Order::where('id', $id)->first();
        /**
         * If the ticket is purchesed by authorized user then it will show ticket
         */
        $check = $orders->user_id == $user_id;
        if ($check) {
            $ticket = Order::where('id', $id)->with('event')->first();
            return view('tickets.PurchasedTicket', compact('ticket'));
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function EmailTicket($id)
    {
        $ticket = Order::where('id', $id)->with('event')->first();
        return view('tickets.PurchasedTicket', compact('ticket'));
    }
}
