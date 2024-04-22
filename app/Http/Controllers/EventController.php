<?php

namespace App\Http\Controllers;

use App\Events\SentEmailForUpdatedEvent;
use App\Events\SentEmailForUpdateEvent;
use App\Jobs\Jobs;
use App\Jobs\UpdateEventSentMail;
use App\Models\Cart;
use App\Models\Events;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    /**
     * Show event list For Organizer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function ShowAllEvents()
    {
        $id = Auth::id();
        $events = Events::where('organizer_id', $id)->orderByDesc('updated_at')->paginate(10);
        return view('events.MyEvent', compact('events'));
    }

    /**
     * Show Create Event Form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function ShowCreateEventPage()
    {
        return view('events.CreateEvent');
    }

    /**
     * Store Event Data to the Database
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createEvent(Request $request)
    {

        /**
         * Validate input field from the form
         */
        $request->validate([
            'name' => 'required|min:3',
            'venue' => 'required|min:3',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i', // validate if the the event date is aftre the today or not 
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'about' => '',
            'image' => 'mimes:jpeg,png,jpg,gif,avif|max:10240',
        ]);
        /**
         * If the Event has the image then it will store the image to the loacl folder in public/storage/event
         * otherwise store image path as null
         */
        if ($request->hasFile('image')) {
            $imagepath = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('event', $imagepath, 'public');
            $imagepath = 'event/' . $imagepath;
        } else {
            $imagepath = null;
        }

        $user = Auth::user();
        /**
         * Change the Date formaye according to Database Entry 
         * then store data to datebase
         */
        $date = Carbon::createFromFormat('m/d/Y', $request['date'], 'UTC')->format('Y-m-d');
        $organizer_id = $user->id;
        Events::create([
            "name" => $request['name'],
            "venue" => $request['venue'],
            "date" => $date,
            "time" => $request['time'],
            "price" => $request['price'],
            "quantity" => $request['quantity'],
            "about" => $request['about'],
            "image" => $imagepath,
            'organizer_id' => $organizer_id,
        ]);
        return redirect()->route("event")->with("success", "Event has been successfully created!");
    }


    /**
     * Show Edit Event Form
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function ShowUpdateEventPage($id)
    {
        /**
         * Find Event data by event_id and get all data
         */
        $event = Events::findOrFail($id);
        $date = $event->date;
        $time = $event->time;
        /**
         * Change the formate of the date and time for the display in the input box
         * Then show all info to edit form
         */
        $newTime = Carbon::createFromFormat('H:i:s', $time)->format('H:i');
        $newDate = Carbon::createFromFormat('Y-m-d', $date)->format('m/d/Y');
        return view('events.UpdateEvent', compact('event', 'newTime', 'newDate'));
    }


    /**
     * Update Event Data
     * @param mixed $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateEvent($id, Request $request)
    {

        /**
         * Validate the data from input field of  form
         */
        $request->validate([
            'name' => 'required|min:3',
            'venue' => 'required|min:3',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'about' => '',
            'imageUpadte' => 'mimes:jpeg,png,jpg,gif,avif|max:10240',
        ]);
        /**
         * If we channge Event image then it will update into databse
         * othewise it will keep it as old image 
         */
        if ($request->hasFile('imageUpadte')) {
            $imagepath = $request->file('imageUpadte')->getClientOriginalName();
            $request->file('imageUpadte')->storeAs('event', $imagepath, 'public');
            $imagepath = 'event/' . $imagepath;
            Events::where('id', $id)->update([
                'image' => $imagepath,
            ]);
        }
        /**
         * Change the formate of the data from the input box according the database formate.
         * then update event data to datbase
         */
        $date = Carbon::createFromFormat('m/d/Y', $request['date'])->format('Y-m-d');
        Events::where('id', $id)->update([
            "name" => $request['name'],
            "venue" => $request['venue'],
            "time" => $request['time'],
            "date" => $date,
            "price" => $request['price'],
            "quantity" => $request['quantity'],
            "about" => $request['about'],
        ]);
        // Jobs::dispatch($id);
        UpdateEventSentMail::dispatch($id);
        return redirect()->route("event")->with("success", "Event successfully updated!");
    }


    /**
     * Delete the Event
     * @param mixed $id
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function deleteEvent($id)
    {
        $Order = Order::where('event_id', $id)->first();
        /**
         * If any user has purchesed the ticket of that event then we can not delete that event
         * otherwise we can delete that event.
         */
        if ($Order) {
            return redirect('event')->with('error', 'This ticket cannot be deleted as it has already been purchased by someone.');
        } else {
            Events::where('id', $id)->delete();
            return redirect('event')->with('error', 'Event Deleted successfully!');
        }
    }
}
