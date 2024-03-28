<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use App\Mail\TestMail;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:7|max:255',
            'terms' => 'accepted',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'terms.accepted' => 'You must accept the terms and conditions'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        $name = $request->input('name');


        $email = $request->input('email');
        $otp = rand(1000, 9999);
        session(['otp' => $otp]);

        Mail::to($email)->send(new TestMail($otp));
        Session::put('email', $email);
        Session::put('otp', $otp);
        Session::put('name', $name);

        Session::put('registration_in_progress', true);

        return Redirect()->route('showOtpForm');
    }


    public function showOtpForm()
    {
        if (Session::get('registration_in_progress')) {
            return view('auth.otp');
        }
        return redirect('/sign-up');
    }
    public function verifyOtp(Request $request)
    {
        $otp = session('otp');
        $userotp = $request->input('d1') . $request->input('d2') . $request->input('d3') . $request->input('d4');

        if ($otp == $userotp) {
            $email = session('email');
            $user = User::where('email', $email)->first();
            Auth::login($user);

            Session::forget('registration_in_progress');


            return redirect(RouteServiceProvider::HOME);
        } else {
            return back()->with('error', 'Invalid OTP. Please try again.');
        }
    }
}
