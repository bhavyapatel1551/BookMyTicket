<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.signin');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        /**
         * Check for user if user not found then it will redirect back with error message.
         */
        if (!$user) {
            return back()->withErrors([
                'message' => 'User with this email does not exist.',
            ])->withInput($request->only('email'));
        }
        /**
         * If user is not verifed then it will redirect to verify page.
         */
        if ($user->email_verified_at ===  null) {
            /**
             * Store Verification data in session for later use when user clicks on resend link or submit form
             * Genrate The random  number for opt and store in session
             * Send the email to user with the random number
             * Redirect to verify otp page
             */
            $name = $user->name;
            $email = $request->input('email');
            $otp = rand(1000, 9999);
            session(['otp' => $otp]);
            Session::put('email', $email);
            Session::put('otp', $otp);
            Session::put('name', $name);
            Mail::to($email)->send(new TestMail($otp, 'Sign-up OTP!'));
            /**
             * Add registration progress on session 
             * redirect to verify opt 
             * 
             */
            Session::put('registration_in_progress', true);
            return redirect()->route('verifyOtp');
        }
        // if same user is trying to access the login page without verify and came form half way to registation prosess.
        /**
         * If same user is trying to access the login page without verify and came from half way to registration process then
         * Clear the OTP attempt in session
         * Redirect to verifyotp page
         */
        if (Session::get('registration_in_progress') && $user) {
            $emailInSession = session('email');

            if ($emailInSession === $request->email) {
                session(['otp_attempts' => 0]);
                return redirect()->route('verifyOtp');
            }
        }
        $credentials = $request->only('email', 'password');
        $rememberMe = $request->rememberMe ? true : false;

        // if the user is verified then it will check for the password and login the user.
        /**
         * If user is verified then it will check for id and password and login the user
         */
        if (Auth::attempt($credentials, $rememberMe)) {
            $request->session()->regenerate();

            /**
             * Clear registration in progress if the user is the same
             */
            if ($user && session('registration_in_progress') == $user->id) {
                Session::forget('registration_in_progress');
            }
            if ($user->email_verified_at) {
                Auth::login($user);

                return redirect()->intended('/dashboard');
            }
            if ($user->email_verified_at ==  null) {
                session(['email' => $request->email, 'registration_in_progress' => $user->id]);

                return redirect()->route('verifyOtp');
            }
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'message' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }




    /**
     * Logout the user
     * Remove data from the session
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/sign-in');
    }
}
