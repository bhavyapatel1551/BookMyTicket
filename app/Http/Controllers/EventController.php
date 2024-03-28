<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Show All the event of the user
    public function ShowAllEvents()
    {
        $id = Auth::id();
        $events = Events::where('organizer_id', $id)->get();
        return view('events.MyEvent', compact('events'));
    }

    // Show Statistic Page for user
    public function ShowStatisticPage()
    {
        return view('events.EventStatistic');
    }

    // Show Create Event From
    public function ShowCreateEventPage()
    {
        return view('events.CreateEvent');
    }

    // Store Event Data to the Database
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
    // Show Edit Event Form
    public function ShowUpdateEventPage($id)
    {
        $event = Events::findOrFail($id);
        $date = $event->date;
        $time = $event->time;
        $newTime = Carbon::createFromFormat('H:i:s', $time)->format('H:i');
        $newDate = Carbon::createFromFormat('Y-m-d', $date)->format('m/d/Y');
        return view('events.UpdateEvent', compact('event', 'newTime', 'newDate'));
    }

    // Update the Event Data 
    public function UpdateEvent($id, Request $request)
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
            Events::where('id', $id)->update([
                'image' => $imagepath,
            ]);
        }
        $date = Carbon::createFromFormat('m/d/Y', $request['date'])->format('Y-m-d');
        Events::where('id', $id)->update([
            "name" => $request['name'],
            "venue" => $request['venue'],
            "time" => $request['time'],
            "date" => $date,
            "price" => $request['price'],
            "about" => $request['about'],
        ]);
        return redirect()->route("event")->with('success', 'Event Updated successfully!');
    }

    // Delete the Event of user 
    public function deleteEvent($id)
    {
        Events::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Event Deleted successfully!');
    }
}
