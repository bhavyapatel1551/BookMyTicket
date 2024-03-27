<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function ShowAllTickets()
    {
        $tickets = Events::all();
        return view('dashboard', compact('tickets'));
    }

    public function TicketInfo($id)
    {
        $ticket = Events::where('id', $id)->first();
        return view('tickets.ticketinfo', compact('ticket'));
    }
}
