<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Show the Admin Dashboard for user management
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user && $user->id === 0) {
            $users = User::paginate(10);
            $sortBy = $request->query('sort_by');
            switch ($sortBy) {
                case 'id':
                    $users = User::orderBy('id', 'asc')->paginate(10);
                    break;
                case 'name':
                    $users = User::orderBy('name', 'asc')->paginate(10);
                    break;
            }
            return view('Admin.UserManagement', compact('users'));
        } else {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Show all the ticket details of the all the users.
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
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

    /**
     * Delete the any user
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $hasEvents = Events::where('organizer_id', $id)->first();
        /**
         * If user has created any event then he can not be deleted by admin
         */
        if ($hasEvents) {
            return redirect()->back()->with('error', 'This user cannot be deleted because they have organized events.');
        }
        /**
         * If user has purchased any tickets then he cannot be deleted by admin
         */
        $hasOrders = Order::where('user_id', $id)->first();
        if ($hasOrders) {
            return redirect()->back()->with('error', 'This user cannot be deleted because they have purchased tickets.');
        }
        /**
         * If the user has paid for the website then he can not be deleted by admin
         */
        $donePayment = User::whereNotNull('email_verified_at');
        if (!$donePayment) {
            return redirect()->back()->with('error', 'You cannot delete this account because it has an active subscription.');
        } else {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        }
    }

    /**
     * Show Purchased order to user and admin
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function purchasedBy($id)
    {
        $organizer = Auth::user();
        $event = Events::find($id);
        // $id = $organizer->id;
        if ($organizer && $event && $organizer->id === 0 || $event->organizer_id === $organizer->id) {
            $purchases = Order::where('event_id', $id)->with('user')->get();
            return view('Admin.purchasedBy', compact('event', 'purchases'));
        } else {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Show user Statistics page to admin
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function UserStatistics()
    {
        $user_id =  Auth::user()->id;
        if ($user_id == 0) {
            $paidUsers = User::whereNotNull('email_verified_at')->paginate(10);
            $totalPaidUsers = User::whereNotNull('email_verified_at')->count();
            $unverifiedUsers = User::whereNull('email_verified_at')->get();
            return view('Admin.UserStatistics', [
                'paidUsers' => $paidUsers,
                'unverifiedUsers' => $unverifiedUsers,
                'totalPaidUsers' => $totalPaidUsers,
            ]);
        } else {
            abort(403, 'Unauthorized');
        }
    }
}
