<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function ShowAllEvents()
    {
        $id = Auth::id();
        $events = Events::where('organizer_id', $id)->get();
        return view('events.MyEvent', compact('events'));
    }
    public function ShowStatisticPage()
    {
        return view('events.EventStatistic');
    }

    public function ShowCreateEventPage()
    {
        return view('events.CreateEvent');
    }

    public function createEvent(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'venue' => 'required|min:3',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'price' => 'required|numeric',
            'about' => '',
            'image' => 'mimes:jpeg,png,jpg,gif,avif|max:10240',
        ]);
        if ($request->hasFile('image')) {
            $imagepath = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('event', $imagepath, 'public');
            $imagepath = 'event/' . $imagepath; // Update the image path to include the 'pfp' folder
        } else {
            $imagepath = null;
        }
        $user = Auth::user();
        $date = Carbon::createFromFormat('m/d/Y', $request['date'], 'UTC')->format('Y-m-d');
        $organizer_id = $user->id;
        Events::create([
            "name" => $request['name'],
            "venue" => $request['venue'],
            "date" => $date,
            "time" => $request['time'],
            "price" => $request['price'],
            "about" => $request['about'],
            "image" => $imagepath,
            'organizer_id' => $organizer_id,
        ]);
        return redirect()->route("event")->with('success', 'Event created successfully!');
    }
}
