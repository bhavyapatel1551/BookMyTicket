<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Show all the Ticket to user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function ShowAllTickets(Request $request)
    {
        /**
         * Sort Ticket based on the option
         */
        $sortBy = $request->query('sort_by');
        $sortBy = $sortBy ?: 'date_asc';
        $tickets = Events::query();
        switch ($sortBy) {
            case 'date_asc':
                $tickets->orderBy('updated_at', 'desc');
                break;
            case 'date_desc':
                $tickets->orderBy('updated_at', 'asc');
                break;
            case 'price_asc':
                $tickets->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $tickets->orderBy('price', 'desc');
                break;
            default:
                $tickets->orderBy('updated_at', 'asc');
        }
        // Search tic
        /**
         * Search Ticket based on Quaery string
         */
        $searchTerm = $request->query('search');
        if ($searchTerm) {
            $tickets->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('venue', 'like', '%' . $searchTerm . '%')
                ->orWhere('price', 'like', '%' . $searchTerm . '%');
        }
        /**
         * Show all data based on user Filtration
         */
        $tickets = $tickets->where('quantity', '>', 0)->whereDate('date', '>', Carbon::today())->paginate(10);
        return view('dashboard', ['tickets' => $tickets]);
    }

    /**
     * Show Specifc Ticket Info
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function EmailTicket($id)
    {
        $ticket = Order::where('id', $id)->with('event')->first();
        return view('tickets.EmailTicket', compact('ticket'));
    }

    /**
     * Show list of user's purchesed order.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function UserTicketOrder()
    {
        return view('tickets.UserTicketOrder');
    }
}
