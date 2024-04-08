<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    // Show the Admin dashboard for user management 
    public function index()
    {
        $user = Auth::user();
        if ($user && $user->id === 0) {
            $users = User::paginate(10);
            return view('Admin.UserManagement', compact('users'));
        } else {
            abort(403, 'Unauthorized');
        }
    }

    // show all the ticket details of the all the users.
    public function tickets($id)
    {
        $user = Auth::user();
        if ($user && $user->id === 0) {

            $username = User::where('id', $id)->first(["name"])->name;
            $events = Events::where('organizer_id', $id)->orderByDesc('created_at')->paginate(5);
            return view('Admin.viewEventsByUserId', compact('events', 'username'));
        } else {
            abort(403, 'Unauthorized');
        }
    }


    // Delete the any user.
    public function destroy($id)
    {

        $hasEvents = Events::where('organizer_id', $id)->first();
        if ($hasEvents) {
            return redirect()->back()->with('error', 'The user has organized events and cannot be deleted.');
        }
        $hasOrders = Order::where('user_id', $id)->first();
        if ($hasOrders) {
            return redirect()->back()->with('error', 'The user has orders as an organizer and cannot be deleted.');
        } else {
            $user = User::findOrFail($id);
            $user->delete();
            // return response()->json(['su' => 'User deleted successfully'])
            return redirect()->back()->with('success', 'User Deleted Succefully.');
        }
    }
    // Show user the data of the purchased tickets by the users
    public function purchasedBy($id)
    {
        $organizer = Auth::user();
        $event = Events::find($id);
        //  here other than the organizer admin can also access this page. if the organizer user is not valid than it will show error page.
        if ($organizer && $event && $organizer->id === 0 || $event->organizer_id === $organizer->id) {
            $purchases = Order::where('event_id', $id)->with('user')->get();
            return view('Admin.purchasedBy', compact('event', 'purchases'));
        } else {
            abort(403, 'Unauthorized');
        }
    }
}
