<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user && $user->id === 0) {
            $users = User::all();
            return view('laravel-examples.users-management', compact('users'));
        } else {
            abort(403, 'Unauthorized');
        }
    }
}
