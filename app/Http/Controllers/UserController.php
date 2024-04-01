<?php

namespace App\Http\Controllers;

use App\Models\Events;
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
            $users = User::all();
            return view('Admin.UserManagement', compact('users'));
        } else {
            abort(403, 'Unauthorized');
        }
    }

    // show all the ticket details of the all the users.
    public function tickets()
    {
        $user = Auth::user();
        if ($user && $user->id === 0) {

            $events = Events::all();
            return view('Admin.UserTicketManagement', compact('events'));
        } else {
            abort(403, 'Unauthorized');
        }
    }


    // Delete the any user.
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting user: ' . $e->getMessage()], 500);
        }
    }
}
