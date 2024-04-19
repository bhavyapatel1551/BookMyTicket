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
use Illuminate\Support\Facades\Log;
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
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Create new user and store the data of user
    public function store(Request $request)
    {
        /**
         * Validate the input field of user
         */
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|max:255',
            'terms' => 'accepted',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'terms.accepted' => 'You must accept the terms and conditions'
        ]);
        /**
         * Create new user and store data into database.
         */
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        /**
         * Genrate the random opt and sent to user's email
         * put all data into sesson to sent along with the email
         */
        $name = $request->input('name');
        $email = $request->input('email');
        $otp = rand(1000, 9999);
        session(['otp' => $otp]);
        Session::put('email', $email);
        Session::put('otp', $otp);
        Session::put('name', $name);
        Mail::to($email)->send(new TestMail($otp, 'Sign-up OTP!'));
        Session::put('registration_in_progress', true);
        return Redirect()->route('showOtpForm');
    }


    /**
     * Show Verify otp form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function showOtpForm()
    {
        /**
         * If the Registration is in the process then show the otp form
         * otherwise redirect to sign-up page
         */
        if (Session::get('registration_in_progress')) {
            return view('auth.otp');
        }
        return redirect('/sign-up');
    }

    /**
     * Genrate OTP for Google signin api
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function GoogleOTP(Request $request)
    {

        $email = $request->query('email');
        $name = $request->query('name');

        $otp = rand(1000, 9999);
        session(['otp' => $otp]);
        Session::put('email', $email);
        Session::put('otp', $otp);
        Session::put('name', $name);
        Mail::to($email)->send(new TestMail($otp, 'Sign-up OTP!'));
        Session::put('registration_in_progress', true);
        return Redirect()->route('showOtpForm');
    }
    /**
     * Verify the OTP from user 
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verifyOtp(Request $request)
    {
        /**
         * If suser is already logged-in then redirect to home route
         */
        if (Auth::check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        /**
         * Get all data from session
         */
        $email = session('email');
        $otp = session('otp');
        $otpAttempts = session('otp_attempts', 0);

        /**
         * If user resent the opt then sent another email and it will increment the otp attempts
         */
        if ($request->input('action') === 'resend') {
            if ($otpAttempts > 2) {
                return back()->with('error', 'You have exceeded the maximum number of OTP generation attempts.');
            } else {
                Mail::to($email)->send(new TestMail($otp, 'New Otp!'));
                session(['otp_attempts' => $otpAttempts + 1]);
                return Redirect()->route('showOtpForm');
            }
        } else {
            $userotp = $request->input('d1') . $request->input('d2') . $request->input('d3') . $request->input('d4');

            /**
             * Verify the OTP
             * Redirect to payment url
             */
            if ($otp == $userotp) {
                session(['otp_verified_' . md5($email) => true]);
                Session::forget('registration_in_progress');
                return redirect()->route('Registration.Fees');
            } else {
                return back()->with('error', 'Invalid OTP. Please try again.');
            }
        }
    }

    /**
     * Show Payment Gate Way Form
     *
     * @return mixed|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function RegistrationFees()
    {
        /**
         * Check if user is already logged-in or not
         */
        if (Auth::check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        $email = session('email');
        $user = User::where('email', $email)->first();
        if ($user->email_verified_at === null) {
            /**
             * Set your Stripe API key.
             * Create Payment Gateway Session.
             */
            \Stripe\Stripe::setApiKey(config('stripe.sk'));
            $paymentGateway = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'INR',
                            'product_data' => [
                                'name' => 'BookMyTicket.com',
                                'description' => 'This fee covers the registration process for accessing and using BookMyTicket.com',
                            ],
                            "recurring" => [
                                "interval" => "year"
                            ],
                            'unit_amount' => 10000,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'customer_email' => $email, // Add customer's email
                'billing_address_collection' => 'required', // Request customer's billing address
                'mode' => 'subscription',
                'success_url' => route('SuccessfullPayment'),
                'cancel_url' => route('sign-up'),
            ]);
            /**
             * Redirect to Stripe url for payment 
             */
            return redirect()->away($paymentGateway->url);
        }
    }

    /**
     * On SuccessFull payment it will login the user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function SuccessfullPayment()
    {
        $email = session('email');
        $user = User::where('email', $email)->first();
        Auth::login($user);
        $user->email_verified_at = now();
        $user->save();
        return redirect('dashboard');
    }
}
