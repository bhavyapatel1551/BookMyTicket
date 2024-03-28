<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Show all the ticket to the user Dashboard
    public function ShowAllTickets()
    {
        $tickets = Events::all();
        return view('dashboard', compact('tickets'));
    }

    // Show the Specific Ticket 
    public function TicketInfo($id)
    {
        $ticket = Events::where('id', $id)->first();
        return view('tickets.TicketInfo', compact('ticket'));
    }

    // Show Ticket order of the user 
    public function UserTicketOrder()
    {
        return view('tickets.UserTicketOrder');
    }
}
